<?php

namespace App\Http\Controllers;

use App\Imports\adminimport;
use App\Models\posyandu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class Administrator extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view("userAdminList", [
            "pageTitle" => "User List",
            "admin" => User::all(),
            "posyandu" => posyandu::all()
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
        if ($request->file("excel")) {
            # code...
            // dd($request->file("excel"));

            $data = Excel::toCollection(new adminimport, $request->file('excel'))->first();

            foreach ($data as $key => $value) {
                if ($value[0]) {
                    # code...
                    $up = $value;
                    $value["uuid"] = Str::uuid();
                    User::create([
                        'name' => $value[1],
                        'email' => $value[2],
                        'password' => $value[3],
                        'uuid' => $value['uuid'],
                    ]);
                }
            }

            return back()->with('success', 'All good!');
        } else {
            $request->validate([
                'name' => "required",
                "email" => 'required|email:rcf,dns|unique:users,email',
                "password" => 'required|min:8|max:16',
                // 'posyandu_id' => "required",
            ]);

            $data = $request->input();
            $data["uuid"] = Str::uuid();

            $add = User::create($data);
            if ($add) {
                return back()->with("success", "User $request->name Berhasil di Tambahkan");
            } else {
                return back()->withErrors("User gagal di Tambahkan");
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $server)
    {
        //
        return $server;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $server)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $server)
    {
        //
        $server->update($request->input());
        return back()->with("success", "User $server->name Berhasil di Update");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $server)
    {
        //
        $getNama = $server->name;
        $server->delete();

        return back()->with("success", "User $getNama Berhasil di hapus");
    }
}
