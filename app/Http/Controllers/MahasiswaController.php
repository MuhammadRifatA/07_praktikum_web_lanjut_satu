<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\Kelas;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */
    public function index()
    {
        //fungsi eloquent menampilkan data menggunakan pagination
        $mahasiswas = Mahasiswa::with('kelas')->get(); // Mengambil semua isi tabel
        $paginate = Mahasiswa::orderBy('nim', 'asc')->paginate(3);
        return view('mahasiswas.index', ['mahasiswas' => $mahasiswas, 'paginate' => $paginate]);
        // with('i', (request()->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('mahasiswas.create', ['kelas' => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validate = $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
        ]);

        if ($request->file('foto')) {
            $nama_foto = $request->file('foto')->store('fotoMahasiswa', 'public');
        } else {
            dd('Foto Tidak ada');
        }

        $Mahasiswa = new Mahasiswa;
        $Mahasiswa->nim = $request->get('nim');
        $Mahasiswa->nama = $request->get('nama');
        $Mahasiswa->kelas_id = $request->get('kelas');
        $Mahasiswa->foto = $nama_foto;
        $Mahasiswa->jurusan = $request->get('jurusan');
        $Mahasiswa->no_handphone = $request->get('no_handphone');
        $Mahasiswa->email = $request->get('email');
        $Mahasiswa->ttl = $request->get('ttl');
        $Mahasiswa->save();

        // $Kelas = new Kelas;
        // $Kelas->id = $request->get('Kelas');

        // $Mahasiswa->kelas()->associate($Kelas);
        $Mahasiswa->save();

        return redirect()->route('mahasiswas.index')
            ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($Nim)
    {
        $Mahasiswa = Mahasiswa::find($Nim);
        return view('mahasiswas.detail', compact('Mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($Nim)
    {
        $kelas = Kelas::all();
        $Mahasiswa = Mahasiswa::where('nim', $Nim)->first();
        return view('mahasiswas.edit', compact('Mahasiswa', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $Nim)
    {
        $validateData =
            $request->validate([
                'nim' => 'required',
                'nama' => 'required',
                // 'ttl' => 'required',
                'kelas_id' => 'required',
                'jurusan' => 'required',
                // 'email' => 'required',
                // 'no_handphone' => 'required',
            ]);
        //fungsi eloquent untuk mengupdate data inputan kita
        Mahasiswa::where('nim', $Nim)->update($validateData);
        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('mahasiswas.index')
            ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($Nim)
    {
        Mahasiswa::where('nim', $Nim)->delete();
        return redirect()->route('mahasiswas.index')
            ->with('success', 'Mahasiswa Berhasil Dihapus');
    }

    public function search(Request $request)
    {
        $data = $request->search;
        $mahasiswas = Mahasiswa::where('nama', 'like', '%' . $data . '%')->paginate(6);
        return view('mahasiswas.index', compact('mahasiswas'));
    }

    public function khs(Mahasiswa $mahasiswa)
    {
        $matkuls = $mahasiswa->matakuliah;


        return view('mahasiswas.khs', [
            'matkuls' => $matkuls,
            'mahasiswa' => $mahasiswa
        ]);
    }
}
