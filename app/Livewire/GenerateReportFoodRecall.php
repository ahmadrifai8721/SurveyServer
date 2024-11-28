<?php

namespace App\Livewire;

use App\Models\foodRecall;
use Livewire\Component;

class GenerateReportFoodRecall extends Component
{

    public $foodRecall;
    public $date;

    public function mount()
    {
        $this->foodRecall = foodRecall::all();
        $this->date =
            date("Y-m-d", strtotime(now()));;
    }

    public function filterData()
    {
        $this->date = date("Y-m-d", strtotime($this->date));

        $data = foodRecall::where("created_at", 'like', "%" . $this->date . "%")->get();
        if ($data->isEmpty()) {
            # code...
            $this->foodRecall = $data;
            session()->flash('success', "Tidak ada data pada tanggal $this->date");
        } else {
            $this->foodRecall = $data;
            session()->flash('error', "Tidak ada data pada tanggal $this->date");
        }
    }

    public function render()
    {
        return view('livewire.generate-report-food-recall',);
    }
}
