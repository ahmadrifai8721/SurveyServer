<?php

namespace App\Http\Controllers;

use App\Models\TopInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        // Check if a new image is uploaded
        $file = $request->file('Image');
        $oldImage = $TopInfo->Images;

        if ($file) {
            // Delete the old image file if it exists
            if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }
            // Store the new image
            $fileUrl = $file->store('topinfo', 'public');
        } else {
            // Keep the old image if no new file is uploaded
            $fileUrl = $oldImage;
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
