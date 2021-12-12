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
        $kartu = DB::table('kartu_soal')
            ->join('kartu_has_kognitif', 'kartu_soal.id_kartu', '=', 'kartu_has_kognitif.id_kartu')
            ->join('kognitif', 'kartu_has_kognitif.id_kognitif', '=', 'kognitif.id_kognitif')
            ->join('soal', 'kartu_soal.id_soal', '=', 'soal.id_soal')
            ->select(DB::raw('kartu_soal.*, soal.*,  GROUP_CONCAT(DISTINCT(aspek_kognitif)) as aspek_kognitif'))
            ->groupBy(
                    'id_kartu',
                    'kartu_soal.id_soal',
                    'soal.id_soal',
                    'no_soal',
                    'soalpil',
                    'soalessay',
                    'gambar',
                    'pilgan_a',
                    'pilgan_b',
                    'pilgan_c',
                    'pilgan_d',
                    'pilgan_e',
                    'kunci_soal',
                    'nama_mapel',
                    'materi',
                    'kelas',
                    'jurusan',
                    'indikator_soal',
                    'jenis_soal',
                    'kartu_soal._token',
                    'soal._token',
                    'kartu_soal.created_at',
                    'soal.created_at',
                    'kartu_soal.updated_at',
                    'soal.updated_at')
            ->get();

        $kd = DB::table('kartu_has_kode')
        ->join('kartu_soal', 'kartu_has_kode.id_kartu', '=', 'kartu_soal.id_kartu')
        ->join('kompetensi_dasar', 'kartu_has_kode.id_kd', '=', 'kompetensi_dasar.id_kd')
        ->select(DB::raw('kartu_soal.id_kartu, kompetensi_dasar.*'))
        ->get();

        return view('kartu.index', ['kartu' => $kartu, 'kd' => $kd]);
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
        $itung = count($mapel);
        $jurusan = DB::table('jurusan')->get();
        $kelas = DB::table('kelas')->get();
        $kognitif = DB::table('kognitif')->get();
        $pengetahuan = DB::table('kompetensi_dasar')
        ->where('jenis_kd', 'Pengetahuan')
        ->whereIn('nama_mapel', $mapel)
        ->get();

        $keterampilan = DB::table('kompetensi_dasar')
        ->where('jenis_kd', 'Keterampilan')
        ->whereIn('nama_mapel', $mapel)
        ->get();
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

        for ($i=0; $i < count($request['id_kd']); $i++) { 
            $datasave = [
                'id_kartu'=>$id_kartu,
                'id_kd'=>$request->id_kd[$i],
            ];

            $insert = DB::table('kartu_has_kode')->insert($datasave);
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
        $pengetahuan = DB::table('kompetensi_dasar')
        ->where('jenis_kd', 'Pengetahuan')
        ->whereIn('nama_mapel', $mapel)
        ->get();

        $keterampilan = DB::table('kompetensi_dasar')
        ->where('jenis_kd', 'Keterampilan')
        ->whereIn('nama_mapel', $mapel)
        ->get();

        $id_soal = DB::table('kartu_soal')->where('id_kartu', $kartu)->value('id_soal');
        $soal = DB::table('soal')->where('id_soal', $id_soal)->get();
        $no_soal = DB::table('soal')->where('id_soal', $id_soal)->value('no_soal');
        $kartu_soal = DB::table('kartu_soal')->where('id_kartu', $kartu)->get();
        $kode_kognitif = DB::table('kartu_has_kognitif')->where('id_kartu', $kartu)->get();
        // dd($kode_kognitif);
        $kode_kd = DB::table('kartu_has_kode')->where('id_kartu', $kartu)->get();

        $kognitif = [];
        foreach ($kode_kognitif as $key => $kognitiff) {
            array_push($kognitif, DB::table('kognitif')->where('id_kognitif', $kognitiff->id_kognitif)->get());
        }

        $kd = [];
        foreach ($kode_kd as $key => $kdd) {
            array_push($kd, DB::table('kompetensi_dasar')->where('id_kd', $kdd->id_kd)->get());
        }
        // dd($kognitif);
        return view('kartu.edit', [
            'kartu'=>$kartu_soal,
            'soal'=>$soal,
            'kognitif'=>$kognitif,
            'kd'=>$kd,
            'mapel' => $mapel,
            'jurusan' => $jurusan,
            'kelas' => $kelas,
            'kognitif' => $kognitif,
            'pengetahuan' => $pengetahuan,
            'keterampilan' => $keterampilan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kartu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kartu)
    {
        $id_soal = DB::table('kartu_soal')->where('id_kartu', $kartu)->value('id_soal');
        $hapus1 = DB::table('soal')->where('id_soal', $id_soal)->delete();
        $hapus2 = DB::table('kartu_soal')->where('id_kartu', $kartu)->delete();
        $hapus3 = DB::table('kartu_has_kognitif')->where('id_kartu', $kartu)->delete();
        $hapus4 = DB::table('kartu_has_kode')->where('id_kartu', $kartu)->delete();
        return redirect()->route('kartu.index')->with('success', 'Data Kartu Soal berhasil di hapus');
    }
}
