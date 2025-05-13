<?php

namespace App\Http\Controllers;

use App\Models\MateriApp;
use App\Models\posyandu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Js;

class MateriAppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view("materiList", [
            "pageTitle" => "Materi List",
            "materi" =>  MateriApp::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $master = MateriApp::latest()->first();
        //
        $data = [];
        foreach (MateriApp::all() as $key => $value) {
            $data[$value->menu] = [
                "Materi_dir" => url($value->materi),
                "Materi_pic_list" => $value->materi_pic_list,
                "Materi_pdf" => $value->materi_pdf,
                "Materi_vid" => $value->materi_vid,
                "cp" => $value->cp,
            ];
        }
        // return $data;
        return response()->json([
            "last_update" => $master ? $master->updated_at : null,
            "menu" => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate(
            [
                'file_materi' => 'required|max:10240', // Ensure the file is a PDF, limit size to 10MB, and ensure uniqueness
                'menu' => 'required|string|unique:materi_apps,menu', // Ensure the menu is a string, not empty, and unique
            ],
            [
                'file_materi.required' => 'File materi tidak boleh kosong',
                // 'file_materi.mimes' => 'File harus berupa PDF',
                'file_materi.max' => 'Ukuran file tidak boleh lebih dari 10MB',
                // 'file_materi.unique' => 'File sudah ada',
                'menu.required' => 'Menu tidak boleh kosong',
                'menu.string' => 'Menu harus berupa string',
                'menu.unique' => 'Menu sudah ada',
            ]
        );

        if ($request->hasFile('file_materi')) {
            // ...
            // return $request->file('file_materi')->getClientOriginalName();
            if (MateriApp::where("menu", $request->menu)->latest()->first()) {
                # code...

                $lastFileneame = explode("storage/materi/", MateriApp::where("menu", $request->menu)->latest()->first()->materi)[1];
                $fileName = $request->file('file_materi')->hashName();

                Storage::delete(
                    "public/materi/" . $lastFileneame
                );

                $file = $request->file('file_materi')->storeAs(
                    "public/materi",
                    $fileName
                );
                MateriApp::updateOrCreate([
                    "menu" => $request->menu
                ])->update([
                    "menu" => $request->menu,
                    "materi" => "storage/materi/" . $fileName,
                    "user_id" => auth()->user()->id
                ]);
                return redirect()->back()->with("success", "Berhasil mengupdate file materi");
            } else {
                # code...

                $fileName = $request->file('file_materi')->hashName();
                $file = $request->file('file_materi')->storeAs(
                    "public/materi",
                    $fileName
                );
                // return $file;
                MateriApp::create([
                    "menu" => $request->menu,
                    "materi" => "storage/materi/" . $fileName,
                    "user_id" => auth()->user()->id
                ]);
                return redirect()->back()->with("success", "Berhasil mengupdate file materi");
            }
        } else {
            return redirect()->back()->withErrors(["File tidak ada"]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MateriApp $materi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MateriApp $materi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MateriApp $materi)
    {
        //
        $request->validate([
            'file_materi' => 'required|mimes:pdf|max:10240', // Ensure the file is a PDF and limit size to 10MB
        ], [
            'file_materi.required' => 'File materi tidak boleh kosong',
            'file_materi.mimes' => 'File harus berupa PDF',
            'file_materi.max' => 'Ukuran file tidak boleh lebih dari 10MB',
        ]);


        if ($request->hasFile('file_materi')) {
            // ...
            // return $request->file('file_materi')->getClientOriginalName();
            if (MateriApp::where("menu", $request->menu)->latest()->first()) {
                # code...

                $lastFileneame = explode("storage/materi/", MateriApp::where("menu", $request->menu)->latest()->first()->materi)[1];
                $fileName = $request->file('file_materi')->hashName();

                Storage::delete(
                    "public/materi/" . $lastFileneame
                );

                $file = $request->file('file_materi')->storeAs(
                    "public/materi",
                    $fileName
                );
                MateriApp::updateOrCreate([
                    "menu" => $request->menu
                ])->update([
                    "menu" => $request->menu,
                    "materi" => "storage/materi/" . $fileName,
                    "user_id" => auth()->user()->id
                ]);
                return redirect()->back()->with("success", "Berhasil mengupdate file materi");
            } else {
                # code...

                $fileName = $request->file('file_materi')->hashName();
                $request->file('file_materi')->storeAs(
                    "public/materi",
                    $fileName
                );
                MateriApp::updateOrCreate([
                    "menu" => $request->menu
                ])->update([
                    "menu" => $request->menu,
                    "materi" => "storage/materi/" . $fileName,
                    "user_id" => auth()->user()->id
                ]);
                return redirect()->back()->with("success", "Berhasil mengupdate file materi");
            }
        } else {
            return redirect()->back()->withErrors(["File tidak ada"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MateriApp $materi)
    {
        //

        $lastFileneame = explode("storage/materi/", $materi->materi)[1];

        // return $lastFileneame[1];
        Storage::delete(
            "public/materi/" . $lastFileneame
        );
        $materi->delete();
        return redirect()->back()->with("success", "Berhasil menghapus file materi");
    }
}
