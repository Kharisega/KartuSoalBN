<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Kode;

use Session;

use App\Exports\KodeExport;
use App\Imports\KodeImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class KodeController extends Controller
{
	public function index()
	{
		$kode = Kode::all();
		return view('kode.index',['kode'=>$kode]);
	}

	public function export_excel()
	{
		return Excel::download(new KodeExport, 'kode.xlsx');
	}

	public function import_excel(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);

		// menangkap file excel
		$file = $request->file('file');

		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();

		// upload ke folder file_siswa di dalam folder public
		$file->move('file_kd',$nama_file);

		// import data
		Excel::import(new KodeImport, public_path('/file_kd/'.$nama_file));

		// notifikasi dengan session
		Session::flash('sukses','Data Kompetensi Dasar Berhasil Diimport!');

		// alihkan halaman kembali
		return redirect('/kode');
	}
}