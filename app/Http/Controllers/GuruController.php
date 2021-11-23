<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guru;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guru = DB::table('guru')
            ->join('guru_has_mapel', 'guru.id_guru', '=', 'guru_has_mapel.id_guru')
            ->join('mapel', 'guru_has_mapel.id_mapel', '=', 'mapel.id_mapel')
            ->join('guru_has_kelas', 'guru.id_guru', '=', 'guru_has_kelas.id_guru')
            ->join('kelas', 'guru_has_kelas.id_kelas', '=', 'kelas.id_kelas')
            ->select(DB::raw('guru.*, GROUP_CONCAT(DISTINCT(nama_mapel)) as nama_mapel, GROUP_CONCAT(DISTINCT(kelas)) as kelas'))
            ->groupBy('id_guru',
                    'nama',
                    'created_at',
                    'updated_at')
            ->get();
        return view('guru.index', compact('guru'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mapel = DB::table('mapel')->get();
        $jurusan = DB::table('jurusan')->get();
        $kelas = DB::table('kelas')->get();
        return view('guru.create', ['mapel'=>$mapel, 'jurusan'=>$jurusan, 'kelas'=>$kelas]);
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
            'nama'=>'required',
        ]);
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $user->assignRole('guru')->get();
        Guru::create([
            'nama'=> $request['nama'],
        ]);

        $id_guru = DB::table('guru')->where('nama', $request['nama'])->value('id_guru');

        for ($i=0; $i < count($request['mapel']); $i++) { 
            $id_mapel = DB::table('mapel')->where('nama_mapel', $request['mapel'][$i])->value('id_mapel');
            
            $datasave = [
                'id_guru'=>$id_guru,
                'id_mapel'=>$id_mapel,
            ];

            $insert = DB::table('guru_has_mapel')->insert($datasave);
        }

        for ($i=0; $i < count($request['kelas']); $i++) { 
            $id_kelas = DB::table('kelas')->where('kelas', $request['kelas'][$i])->value('id_kelas');
            
            $datasave = [
                'id_guru'=>$id_guru,
                'id_kelas'=>$id_kelas,
            ];

            $insert = DB::table('guru_has_kelas')->insert($datasave);
        }

        return redirect()->route('guru.index')->with('success', "Data Guru Berhasil di input");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('guru.index', compact('guru'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($guru)
    {
        // dd($guru);
        $guru = DB::table('guru')->where('id_guru', $guru)->get();
        // dd($guru);
        return view('guru.edit', ['guru'=>$guru]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Guru $guru)
    {
        $request->validate([
            'nama'=>'required',
        ]);
        $guru->update($request->all());
        return redirect()->route('guru.index')->with('success', "Data Guru berhasil di update");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guru $guru)
    {
        $guru->delete();
        return redirect()->route('guru.index')->with('success', 'Data Guru berhasil di hapus');
    }
}
