<?php

namespace App\Http\Controllers;

use App\Models\Automobile;
use Illuminate\Http\Request;

class AutomobileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('automobiles.index', [
            'automobiles' => Automobile::with('driver')->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Automobile $automobile)
    {
        return view('automobiles._automobile', [
            'automobile' => $automobile->load('driver')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Automobile $automobile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Automobile $automobile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Automobile $automobile)
    {
        //
    }
}
