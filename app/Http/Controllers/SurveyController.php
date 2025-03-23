<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("surveyList", [
            "pageTitle" => "Daftar Hasil Survey| Kiss Bunda",
            "survey" => Survey::all()->sortBy("tanggal"),
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
    public function show(Survey $survey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Survey $survey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Survey $survey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Survey $survey)
    {
        //
    }
    /**
     * Print Document.
     */
    public function print()
    {
        $dataTK = [];
        $dataTanggal = [];

        $survey = Survey::all();

        $dateStart = request()->input("dateStart") === null ? strtotime($survey->first()->tanggal) : strtotime(request()->input("dateStart"));
        $datelast = request()->input("dateLast") === null ? strtotime($survey->last()->tanggal) : strtotime(request()->input("dateLast"));
        $surveyGroup = $survey->groupBy("tingkatKepuasan");

        foreach ($surveyGroup as $key => $value) {

            $dataTK[$key] = $value->groupBy("tanggal");
        }
        foreach ($dataTK as $key => $value) {
            foreach ($value as $tanggal => $data) {
                if ($dateStart <= strtotime($tanggal) && $datelast >= strtotime($tanggal)) {
                    # code...
                    $dataTanggal[$key][date("j", strtotime($tanggal))] = $data;
                }
            }
        }
        $dataTanggal = collect($dataTanggal)->map(function ($item) {
            return collect($item);
        });
        // dump($dataTanggal);
        // dd($dateStart, $datelast, $dataTK, $dataTanggal);
        //


        return view("surveyListPrint", [
            "pageTitle" => "Survey Report | Kiss Bunda " . request()->input('dateStart') . " Sampai " . request()->input('dateLast'),
            'dateStart' => $dateStart,
            'dateLast' => $datelast,
            "data" => $dataTanggal
        ]);
    }
}
