<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kognitif;
use Illuminate\Support\Facades\DB;

class KognitifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kognitif = Kognitif::paginate(5);
        return view('kognitif.index', compact('kognitif'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kognitif.create');
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
            'aspek_kognitif'=>'required',
            'ket_kognitif'=>'required',
        ]);
        Kognitif::create($request->all());
        return redirect()->route('kognitif.index')->with('success', "Data Aspek Kognitif Berhasil di tambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Kognitif $kognitif)
    {
        return view('kognitif.index', compact('kognitif'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kognitif)
    {
        $kognitif = DB::table('kognitif')->where('id_kognitif', $kognitif)->get();
        return view('kognitif.edit', ['kognitif'=>$kognitif]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kognitif $kognitif)
    {
        $request->validate([
            'aspek_kognitif'=>'required',
            'ket_kognitif'=>'required',
        ]);
        $kognitif->update($request->all());
        return redirect()->route('kognitif.index')->with('success', "Data Aspek Kognitif berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kognitif $kognitif)
    {
        $kognitif->delete();
        return redirect()->route('kognitif.index')->with('success', 'Data Aspek Kognitif berhasil di hapus');
    }
}
