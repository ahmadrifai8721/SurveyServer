<?php

namespace App\Http\Controllers;

use App\Models\Respondent;
use Illuminate\Http\Request;

class UsersList extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view("userList", [
            "pageTitle" => "Daftar Responden",
            "responden" => Respondent::all()
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
    public function show(Respondent $respondent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Respondent $respondent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Respondent $respondent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Respondent $respondent)
    {
        //
    }
}
