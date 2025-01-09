<?php

namespace App\Livewire;

use App\Exports\foodrecallExport;
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
            date("j-m-Y", strtotime(now()));
    }

    public function filterData()
    {
        $this->date = date("j-m-Y", strtotime($this->date));

        $data = foodRecall::where("tanggal", 'like', "%" . $this->date . "%")->get();
        // dd($this->date);
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
