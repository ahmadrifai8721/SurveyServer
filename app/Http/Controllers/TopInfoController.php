<?php

namespace App\Http\Controllers;

use App\Models\TopInfo;
use Illuminate\Http\Request;

class TopInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('topInfo', [
            'TopInfo' => TopInfo::all(),
            'pageTitle' => 'Top Info',
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
        $fileUrl = $request->file('Image')->store('topinfo', 'public');
        TopInfo::create([
            'Images' => $fileUrl,
            'Keterangan' => $request->input('Keterangan'),
        ]);
        return redirect()->back()->with("success", "Berhasil menambahkan Top Info");
    }

    /**
     * Display the specified resource.
     */
    public function show(TopInfo $TopInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TopInfo $TopInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TopInfo $TopInfo)
    {
        //
        // return $TopInfo;
        $fileUrl = $request->file('Image');
        if (!$fileUrl) {
            $fileUrl = $TopInfo->Images; // Keep the old image if no new file is uploaded
        } else {
            $fileUrl = $fileUrl->store('topinfo', 'public');
        }
        $TopInfo->update([
            'Images' => $fileUrl,
            'Keterangan' => $request->input('Keterangan'),
        ]);
        return redirect()->back()->with("success", "Berhasil mengupdate Top Info");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TopInfo $TopInfo)
    {
        $TopInfo->delete();

        return redirect()->back()->with("success", "Berhasil menghapus  Top Info");
    }
}
