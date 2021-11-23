<?php

namespace App\Http\Controllers;

use App\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jurusan = Jurusan::latest()->paginate(5);
        return view('jurusan.index', compact('jurusan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jurusan.create');
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
            'jurusan'=>'required',
            'alias'=>'required',
        ]);
        Jurusan::create($request->all());
        return redirect()->route('jurusan.index')->with('success', "Data Kompetensi Keahlian Berhasil di input");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function show(Jurusan $jurusan)
    {
        return view('jurusan.index', compact('jurusan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function edit($jurusan)
    {
        // dd($jurusan);
        $jurusan = DB::table('jurusan')->where('id_jurusan', $jurusan)->get();
        // dd($jurusan);
        return view('jurusan.edit', ['jurusan'=>$jurusan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jurusan $jurusan)
    {
        // dd($request);
        $request->validate([
            'jurusan'=>'required',
            'alias'=>'required',
        ]);
        $jurusan->update($request->all());
        return redirect()->route('jurusan.index')->with('success', "Data Kompetensi Keahlian berhasil di update");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        return redirect()->route('jurusan.index')->with('success', 'Data Kompetensi Keahlian berhasil di hapus');
    }
}
