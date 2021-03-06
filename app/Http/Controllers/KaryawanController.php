<?php

namespace App\Http\Controllers;

use App\Models\karyawan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Session;


class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawan = Karyawan::all();
        return view('karyawan.index', compact('karyawan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('karyawan.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $karyawan = new Karyawan;
        // $karyawan->id_karyawan = $request->id_karyawan;
        $karyawan->nama_karyawan = $request->nama_karyawan;
        $karyawan->save();
        Alert::success('Success Menambahkan Karyawan');
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Data saved successfully",
        ]);
        return redirect()->route('karyawan.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $karyawan = karyawan::findOrFail($id);
        return view('karyawan.show', compact('karyawan'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $karyawan = karyawan::findOrFail($id);
        return view('karyawan.edit', compact('karyawan'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            // 'id_karyawan' => 'required',
            'nama_karyawan' => 'required',

        ]);
        $karyawan = karyawan::findOrFail($id);
        // $karyawan->id_karyawan = $request->id_karyawan;
        $karyawan->nama_karyawan = $request->nama_karyawan;
        $karyawan->save();
        Alert::success('Success Mengedit Karyawan');
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Data edited successfully",
        ]);
        return redirect()->route('karyawan.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $karyawan = karyawan::findOrFail($id);
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Data deleted successfully",
        ]);
        $karyawan->delete();
        Alert::success('Success Menghapus Kategori');
        return redirect()->route('karyawan.index');
    }
}
