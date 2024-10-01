<?php

namespace App\Http\Controllers;

use App\Imports\balitaImport;
use App\Models\daftarBalita;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class daftarBalitaController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view("daftarBalita", [
            "pageTitle" => "daftarBalita List",
            "balita" => daftarBalita::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request) {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        if ($request->file("excel")) {
            # code...
            // dd($request->file("excel"));

            Excel::import(new balitaImport, $request->file('excel'));

            return back()->with('success', 'All good!');
        } else {


            $request->validate([
                'namaBalita' => "required",
                "namaIbu" => 'required',
            ]);

            $data = $request->input();

            $add = daftarBalita::create($data);
            if ($add) {
                return back()->with("success", "daftarBalita $request->name Berhasil di Tambahkan");
            } else {
                return back()->withErrors("daftarBalita gagal di Tambahkan");
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(daftarBalita $daftarBalitum)
    {
        //
        return $daftarBalitum;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(daftarBalita $daftarBalitum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, daftarBalita $daftarBalitum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(daftarBalita $daftarBalitum)
    {
        //
    }
}
