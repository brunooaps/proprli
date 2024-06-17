<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Http\Controllers\Controller;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $buildings = Building::all();

        return view('buildings.index', compact('buildings'));
    }
}
