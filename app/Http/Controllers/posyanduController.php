<?php

namespace App\Http\Controllers;

use App\Imports\posyanduImport;
use App\Models\posyandu;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class posyanduController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        if ($request->file("posyandu")) {
            # code...
            // dd($request->file("posyandu"));
            posyandu::truncate();
            Excel::import(new posyanduImport, $request->file('posyandu'));

            return back()->with('success', 'Data Posyandu Berhasil Di Perbaharui');
        };
    }

    /**
     * Display the specified resource.
     */
    public function show(posyandu $posyandu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(posyandu $posyandu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, posyandu $posyandu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(posyandu $posyandu)
    {
        //
    }
}
