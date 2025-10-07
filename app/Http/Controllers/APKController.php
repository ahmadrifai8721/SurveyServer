<?php

namespace App\Http\Controllers;

use App\Models\APK;
use Illuminate\Http\Request;

class APKController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        // free space check
        $bytes = disk_free_space(".");
        $bytest = disk_total_space(".");
        $si_prefix = array('B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB');
        $base = 1024;
        $class = min((int)log($bytes, $base), count($si_prefix) - 1);

        $freeSpace = sprintf('%1.2f', $bytes / pow($base, $class)) . ' ' . $si_prefix[$class];
        $totalSpace =  sprintf('%1.2f', $bytest / pow($base, $class)) . ' ' . $si_prefix[$class];
        $usedSpace = $bytest - $bytes;
        $freeSpacePercentage = ($bytes / $bytest) * 100;

        return view("APK", [
            "pageTitle" => "APK rilis majemen",
            "apk" => APK::all(),
            "freeSpace" => $freeSpace,
            "totalSpace" => $totalSpace,
            "usedSpace" => $usedSpace,
            "freeSpacePercentage" => $freeSpacePercentage,
            "downloaded" => APK::sum('download'),
            "uploaded" => APK::count(),
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


        $request->validate(
            [
                'APK' => 'required|file|mimes:zip|max:51200', // max 50MB, must be APK
                'description' => 'required|string|max:255',
                'version' => 'required|string|max:50|unique:a_p_k_s,version',
            ],
            [
                'APK.required' => 'validation.required',
                'APK.file' => 'The uploaded file must be a valid file.',
                'APK.mimes' => 'The file must be an APK.',
                'APK.max' => 'The APK file may not be greater than 50MB.',
                'description.required' => 'Description required',
                'description.string' => 'Description must be a string.',
                'description.max' => 'Description may not be greater than 255 characters.',
                'version.required' => 'Version required',
                'version.string' => 'Version must be a string.',
                'version.max' => 'Version may not be greater than 50 characters.',
                'version.unique' => 'The version has already been taken. Please use a different version.',
            ]
        );

        // Store the file with original name and .apk extension
        $file = $request->file('APK');
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '.apk';
        $path = $file->storeAs('apks', $originalName, 'public');

        // Save to database
        $apk = new APK();
        $apk->name = $originalName;
        $apk->file_path = $path;
        $apk->size = $file->getSize();
        $apk->description = $request->input('description') !== null ? $request->input('description') : 'not set';
        $apk->version =  $request->input('version') !== null ? $request->input('version') : 'not set';
        $apk->save();
        // dd($apk);
        return redirect()->route('APK.index')->with('success', 'APK uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(APK $APK)
    {
        //
        return view("downloadInfo", [
            "pageTitle" => "Download " . $APK->name,
            "apk" => $APK
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(APK $APK)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, APK $APK)
    {
        //
        $APK->update($request->all());
        return redirect()->route('APK.index')->with('success', 'APK updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(APK $APK)
    {
        //
        $APK->delete();
        return redirect()->route('APK.index')->with('success', 'APK deleted successfully.');
    }

    public function generateQRCode(APK $apk, $size)
    {
        return view('qrcode', ['apk' => $apk, 'size' => $size]);
    }
}
