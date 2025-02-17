<?php

namespace App\Http\Controllers;

use App\Models\foodRecall;
use Illuminate\Http\Request;

class FoodRecallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view("foodRecall", [
            "pageTitle" => "Food Recal Report",
            "foodRecall" => foodRecall::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("foodRecallLaporan", [
            "pageTitle" => "Food Recal Generate Report",
        ]);
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
    public function show(foodRecall $foodRecall, Request $request)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(foodRecall $foodRecall)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, foodRecall $foodRecall)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(foodRecall $foodRecall)
    {
        //
        $data = $foodRecall->daftarBalita->namaBalita . " data tanggal $foodRecall->created_at Berhasil Di Hapus";
        $foodRecall->delete();
        return back()->with('success', "Data $data");
    }
}
