<?php

namespace App\Http\Controllers;

use App\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mapel = Mapel::latest()->paginate(5);
        return view('mapel.index', compact('mapel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mapel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel'=>'required',
            'jenis_mapel'=>'required',
        ]);
        Mapel::create($request->all());
        return redirect()->route('mapel.index')->with('success', "Data Mata Pelajaran Berhasil di input");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function show(Mapel $mapel)
    {
        return view('mapel.index', compact('mapel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function edit($mapel)
    {
        // dd($jurusan);
        $mapel = DB::table('mapel')->where('id_mapel', $mapel)->get();
        // dd($mapel);
        return view('mapel.edit', ['mapel'=>$mapel]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mapel $mapel)
    {
        // dd($request);
        $request->validate([
            'nama_mapel'=>'required',
            'jenis_mapel'=>'required',
        ]);
        $mapel->update($request->all());
        return redirect()->route('mapel.index')->with('success', "Data Mata Pelajaran berhasil di update");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mapel $mapel)
    {
        $mapel->delete();
        return redirect()->route('mapel.index')->with('success', 'Data Mata Pelajaran berhasil di hapus');
    }
}
