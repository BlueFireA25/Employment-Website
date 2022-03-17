<?php

namespace App\Http\Controllers;

use App\Models\Vacant;
use App\Models\Location;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $vacancies = Vacant::latest()->where('active', true)->take(10)->get();
        $locations = Location::all();

        return view('home.index', compact('vacancies', 'locations'));
    }
}
