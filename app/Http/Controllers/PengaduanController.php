<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Bukti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.pengaduan.user.index', [
            'pengaduan' => Pengaduan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pengaduan.user.create', [
            'pengaduan' => Pengaduan::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePengaduanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data
        $validasiData = $request->validate([
            'barang' => 'required|max:255',
            'tgl-hilang' => 'required|date',
            'waktu-hilang' => 'required',
            'lokasi-hilang' => 'required|max:255',
            'kronologi' => 'required|min:10',
            'bukti.*' => 'image|file|max:2048'
        ]);

        // Simpan data pengaduan ke tabel 'pengaduan'
        $pengaduan = Pengaduan::create([
            'id_user' => auth()->id(),
            'barang_hilang' => $validasiData['barang'],
            'tgl_hilang' => $validasiData['tgl-hilang'],
            'waktu_hilang' => $validasiData['waktu-hilang'],
            'lokasi_hilang' => $validasiData['lokasi-hilang'],
            'kronologi' => $validasiData['kronologi'],
        ]);

        // Simpan bukti jika ada
        if ($request->hasFile('bukti')) {
            foreach ($request->file('bukti') as $file) {
                Bukti::create([
                    'pengaduan_id' => $pengaduan->id,
                    'bukti' => $file->store('Bukti-Pengaduan')
                ]);
            }
        }

        return redirect('/daftar-pengaduan-user')->with('sukses', 'Anda Berhasil Mengirim Pengaduan');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengaduan $pengaduan, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        return view('dashboard.pengaduan.user.show', [
            'pengaduan' => $pengaduan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengaduan $pengaduan, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        return view('dashboard.pengaduan.user.edit', [
            'pengaduan' => $pengaduan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePengaduanRequest  $request
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
   public function update(Request $request, $id)
{
    // Validasi input
    $validasiData = $request->validate([
        'barang' => 'required|max:255',
        'tgl-hilang' => 'required|date',
        'waktu-hilang' => 'required',
        'lokasi-hilang' => 'required|max:255',
        'kronologi' => 'required|min:10',
        'bukti.*' => 'image|file|max:2048'
    ]);

    // Cari pengaduan berdasarkan ID
    $pengaduan = Pengaduan::find($id);

    // Jika pengaduan tidak ditemukan, kembalikan ke halaman daftar dengan pesan error
    if (!$pengaduan) {
        return redirect('/daftar-pengaduan-user')->with('error', 'Pengaduan tidak ditemukan');
    }

    // Update data pengaduan
    $pengaduan->barang_hilang = $validasiData['barang'];
    $pengaduan->tgl_hilang = $validasiData['tgl-hilang'];
    $pengaduan->waktu_hilang = $validasiData['waktu-hilang'];
    $pengaduan->lokasi_hilang = $validasiData['lokasi-hilang'];
    $pengaduan->kronologi = $validasiData['kronologi'];
    $pengaduan->save();

    // Hapus gambar lama jika checkbox tercentang
    if ($request->has('delete_old_images')) {
        foreach ($pengaduan->bukti as $bukti) {
            // Hapus gambar dari penyimpanan
            Storage::delete($bukti->bukti);
            // Hapus data bukti dari database
            $bukti->delete();
        }
    }

    // Simpan gambar baru jika ada
    if ($request->hasFile('bukti')) {
        foreach ($request->file('bukti') as $file) {
            // Simpan file gambar dan buat entri di database
            Bukti::create([
                'pengaduan_id' => $pengaduan->id,
                'bukti' => $file->store('Bukti-Pengaduan', 'public')
            ]);
        }
    }

    // Redirect ke halaman daftar pengaduan dengan pesan sukses
    return redirect('/daftar-pengaduan-user')->with('sukses', 'Pengaduan berhasil diperbarui');
}




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Cari pengaduan berdasarkan ID
        $pengaduan = Pengaduan::find($id);

        // Jika pengaduan tidak ditemukan, kembalikan ke halaman daftar dengan pesan error
    if (!$pengaduan) {
        return redirect('daftar-pengaduan-user')->with('error', 'Pengaduan tidak ditemukan');
    }

    // Ambil daftar bukti yang terkait dengan pengaduan
    $buktiList = Bukti::where('pengaduan_id', $pengaduan->id)->get();

    // Loop melalui setiap bukti dan hapus dari penyimpanan
    foreach ($buktiList as $bukti) {
        // Pastikan file tersebut ada sebelum menghapus
        if (Storage::disk('public')->exists($bukti->bukti)) {
            Storage::disk('public')->delete($bukti->bukti);
        } else {
            \Log::warning('File not found: ' . $bukti->bukti);
        }

        // Hapus data bukti dari database
        $bukti->delete();
    }

    // Hapus data pengaduan dari database
    $pengaduan->delete();

    // Redirect ke halaman daftar pengaduan dengan pesan sukses
        return redirect('daftar-pengaduan-user')->with('sukses', 'Pengaduan dan semua bukti terkait telah dihapus');
    }
}
