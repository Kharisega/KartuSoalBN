<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kartu;
use Illuminate\Support\Facades\DB;

class KartuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kartu = Kartu::latest()->paginate(5);
        return view('kartu.index', ['kartu' => $kartu,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $name = auth()->user()->name;
        $id_guru = DB::table('guru')->where('nama', $name)->value('id_guru');
        $id_mapel = DB::table('guru_has_mapel')->select('id_mapel')->where('id_guru', $id_guru)->get();
        $mapel = [];
        foreach ($id_mapel as $key => $mapell) {
            array_push($mapel, DB::table('mapel')->where('id_mapel', $mapell->id_mapel)->value('nama_mapel'));
        }

        $jurusan = DB::table('jurusan')->get();
        $kelas = DB::table('kelas')->get();
        $kognitif = DB::table('kognitif')->get();
        $pengetahuan = DB::table('kompetensi_dasar')->where('jenis_kd', 'Pengetahuan')->get();
        $keterampilan = DB::table('kompetensi_dasar')->where('jenis_kd', 'Keterampilan')->get();
        // dd($pengetahuan);
        return view('kartu.create', [
            'mapel' => $mapel,
            'jurusan' => $jurusan,
            'kelas' => $kelas,
            'kognitif' => $kognitif,
            'pengetahuan' => $pengetahuan,
            'keterampilan' => $keterampilan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        return view('kartu.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kartu)
    {
        $kartu = DB::table('kartu')->where('id_kartu', $kartu)->get();
        return view('kartu.edit', ['kartu'=>$kartu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kartu $kartu)
    {
        $kartu->delete();
        return redirect()->route('kartu.index')->with('success', 'Data Kartu Soal berhasil di hapus');
    }
}
