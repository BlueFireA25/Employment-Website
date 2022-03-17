<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Vacant;
use App\Models\Category;
use App\Models\Location;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VacantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$vacancies = auth()->user()->vacancies;
        $vacancies = Vacant::where('user_id', auth()->user()->id)->latest()->paginate(2);

        return view('vacancies.index', compact('vacancies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get
        $categories = Category::all();
        $experiences = Experience::all();
        $locations = Location::all();
        $salaries = Salary::all();

        return view('vacancies.create', compact('categories', 'experiences', 'locations', 'salaries'));
            // ->with('categories', $categories)
            // ->with('experiences', $experiences)
            // ->with('locations', $locations)
            // ->with('salaries', $salaries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate
        $data = $request->validate([
            'title' => 'required|min:8',
            'category' => 'required',
            'experience' => 'required',
            'location' => 'required',
            'salary' => 'required',
            'description' => 'required|min:50',
            'image' => 'required',
            'skills' => 'required'
        ]);

        // Store in DB
        auth()->user()->vacancies()->create([
            'title' => $data['title'],
            'image' => $data['image'],
            'description' => $data['description'],
            'skills' => $data['skills'],
            'category_id' => $data['category'],
            'experience_id' => $data['experience'],
            'location_id' => $data['location'],
            'salary_id' => $data['salary']
        ]);

        return redirect()->route('vacancies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vacant  $vacant
     * @return \Illuminate\Http\Response
     */
    public function show(Vacant $vacant)
    {
        //if($vacant->active === 0) return abort(404);

        return view('vacancies.show')->with('vacant', $vacant);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vacant  $vacant
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacant $vacant)
    {
        $this->authorize('view', $vacant);

        // Get
        $categories = Category::all();
        $experiences = Experience::all();
        $locations = Location::all();
        $salaries = Salary::all();

        return view('vacancies.edit', compact('categories', 'experiences', 'locations', 'salaries', 'vacant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vacant  $vacant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vacant $vacant)
    {
        $this->authorize('update', $vacant);

        // Validate
        $data = $request->validate([
            'title' => 'required|min:8',
            'category' => 'required',
            'experience' => 'required',
            'location' => 'required',
            'salary' => 'required',
            'description' => 'required|min:50',
            'image' => 'required',
            'skills' => 'required'
        ]);

        $vacant->title = $data['title'];
        $vacant->skills = $data['skills'];
        $vacant->image = $data['image'];
        $vacant->description = $data['description'];
        $vacant->category_id = $data['category'];
        $vacant->experience_id = $data['experience'];
        $vacant->location_id = $data['location'];
        $vacant->salary_id = $data['salary'];

        $vacant->save();

        return redirect()->route('vacancies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vacant  $vacant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacant $vacant, Request $request)
    {
        $this->authorize('delete', $vacant);

        $vacant->candidates()->delete();
        $vacant->delete();

        return response()->json(['message' => 'The Vacant was eliminated' . $vacant->title]);
    }

    public function image(Request $request)
    {
        $image = $request->file('file');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('storage/vacancies'), $imageName);

        return response()->json(['correct' => $imageName]);
    }

    public function imageDelete(Request $request)
    {
        if($request->ajax()){
            $image = $request->get('image');

            if(File::exists('storage/vacancies/' . $image)) {
                File::delete('storage/vacancies/' . $image);
            }

            return response('Image Delete', 200);
        }
    }

    // Change status of a vacant
    public function status(Request $request, Vacant $vacant)
    {
        // Read new status and set
        $vacant->active = $request->status;

        // Store in the DB
        $vacant->save();

        return response()->json(['answer' => 'success']);
    }

    public function search(Request $request) {

        // Validation
        $data = $request->validate([
            'category' => 'required',
            'location' => 'required'
        ]);

        // Set values
        $category = $data['category'];
        $location = $data['location'];

        $vacancies = Vacant::latest()
            ->where('category_id', $category)
            ->Where('location_id', $location)
            ->get();

        // $vacancies = Vacant::where([
        //     'category_id' => $category,
        //     'location_id' => $location
        // ])->get();

        return view('search.index', compact('vacancies'));
    }

    public function results() {
        return "Mostrando resultados";
    }
}
