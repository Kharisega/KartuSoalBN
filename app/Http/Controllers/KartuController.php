<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kartu;
use App\Soal;
use Illuminate\Support\Facades\DB;

use Image;

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
        // dd($request);
        $request->validate([
            'mapel' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'no_soal' => 'required',
            'id_kd_peng' => 'required',
            'id_kd_ket' => 'required',
            'materi' => 'required',
            'indikator_soal' => 'required',
            'kognitif' => 'required',
            'jenis_nilai' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024'
        ]);

        $image = $request->file('gambar');
        $nameImage = $request->file('gambar')->getClientOriginalName();

        $thumbImage = Image::make($image->getRealPath())->resize(100, 100);
        $thumbPath = public_path() . '/fotosoal/' . $nameImage;
        $thumbImage = Image::make($thumbImage)->save($thumbPath);

        $token = rand();
        $soal = Soal::create([
            'no_soal' => $request['no_soal'],
            'soalpil' => $request['soalpil'],
            'soalessay' => $request['soalessay'],
            'gambar' => $nameImage,
            'pilgan_a' => $request['pilgan_a'],
            'pilgan_b' => $request['pilgan_b'],
            'pilgan_c' => $request['pilgan_c'],
            'pilgan_d' => $request['pilgan_d'],
            'pilgan_e' => $request['pilgan_e'],
            'kunci_soal' => $request['kunci_soal'],
            '_token' => $token,
        ]);

        $id_soal = DB::table('soal')->where('_token', $token)->value('id_soal');

        $insert = Kartu::create([
            'id_soal' => $id_soal,
            'materi' => $request['materi'],
            'nama_mapel' => $request['mapel'],
            'kelas' => $request['kelas'],
            'jurusan' => $request['jurusan'],
            'indikator_soal' => $request['indikator_soal'],
            'jenis_soal' => $request['jenis_nilai'],
            'id_kd_peng' => $request['id_kd_peng'],
            'id_kd_ket' => $request['id_kd_ket'],
            '_token' => $token,
        ]);

        $id_kartu = DB::table('kartu_soal')->where('_token', $token)->value('id_kartu');

        for ($i=0; $i < count($request['kognitif']); $i++) { 
            $datasave = [
                'id_kartu'=>$id_kartu,
                'id_kognitif'=>$request->kognitif[$i],
            ];

            $insert = DB::table('kartu_has_kognitif')->insert($datasave);
        }

        return redirect()->route('kartu.index')->with('success', "Kartu Soal Berhasil ditambahkan");
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
