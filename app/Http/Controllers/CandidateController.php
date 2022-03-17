<?php

namespace App\Http\Controllers;

use App\Models\Vacant;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Notifications\NewCandidate;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Get current id
        $id_vacant = $request->route('id');

        // Get candidates and vacant
        $vacant = Vacant::findOrFail($id_vacant);

        $this->authorize('view', $vacant);

        return view('candidates.index', compact('vacant'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'cv' => 'required|mimes:pdf|max:1000',
            'vacant_id' => 'required'
        ]);

        // Store pdf file
        if($request->file('cv'))
        {
            $file = $request->file('cv');
            $fileName = time() . "." . $request->file('cv')->extension();
            $location = public_path('storage/cv');
            $file->move($location, $fileName);
        }

        $vacant = Vacant::find($data['vacant_id']);

        $vacant->candidates()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'cv' => $fileName
        ]);

        $recruiter = $vacant->recruiter;
        $recruiter->notify(new NewCandidate($vacant->title, $vacant->id));

        $message = "Your data was sent correctly!: Luck";

        return back()->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function show(Candidate $candidate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidate $candidate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidate $candidate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidate $candidate)
    {
        //
    }
}
