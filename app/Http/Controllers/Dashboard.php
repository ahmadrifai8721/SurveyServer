<?php

namespace App\Http\Controllers;

use App\Models\activeUsers;
use App\Models\downloadRecord;
use App\Models\foodRecall;
use App\Models\Respondent;
use App\Models\Survey;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class Dashboard extends Controller
{
    public function index()
    {
        $respodent  = Respondent::all();
        $survey = Survey::all();
        $getcategoryChart = $survey->groupBy("tanggal");
        $getDataChart = $survey->groupBy("tingkatKepuasan");
        $download = downloadRecord::all();
        $activeUser = activeUsers::all();
        // dd($getDataChart);

        // set chart data
        $category = [];
        $data = [];
        foreach ($getcategoryChart as $key => $value) {
            $category[] = $key;
            $data[1][$key] = $value->where("tingkatKepuasan", 1)->count() == 0 ? 0 : $value->where("tingkatKepuasan", 1)->count();
            $data[2][$key] = $value->where("tingkatKepuasan", 2)->count() == 0 ? 0 : $value->where("tingkatKepuasan", 2)->count();
            $data[3][$key] = $value->where("tingkatKepuasan", 31)->count() == 0 ? 0 : $value->where("tingkatK3puasan", 1)->count();
            $data[4][$key] = $value->where("tingkatKepuasan", 41)->count() == 0 ? 0 : $value->where("tingkatK4puasan", 1)->count();
        }
        // dump($data);
        // die();

        $foo = [];
        foreach (foodRecall::all()->groupBy("tanggal")->sortBy("created_at") as $key => $value) {
            # code...
            $foo[$key != null ? $key : "0"] = $value->count();
        }

        return view("Analytics", [
            "pageTitle" => "Dashboard | Kiss Bunda",
            "activeUser" => $activeUser,
            "downloaded" => $download,
            "respondent" => $respodent,
            "survey" => $survey,
            "category" => $category,
            "data" => $data,
            "foodRecallReport" => $foo
        ]);
    }
}
