<?php

namespace App\Http\Controllers;

use App\Models\buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 3;
        if (strlen($katakunci)) {
            $data = buku::where('id_buku', 'like', "%$katakunci%")
            ->orWhere('judul', 'like', "%$katakunci%")
            ->orWhere('pengarang', 'like', "%$katakunci%")
            ->orWhere('biaya', 'like', "%$katakunci%")
            ->paginate($jumlahbaris);
        }else{
            $data = buku::orderBy('id_buku', 'desc')->paginate(3);
        }
        return view('buku.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('id_buku', $request->id_buku);
        Session::flash('judul', $request->judul);
        Session::flash('pengarang', $request->pengarang);
        Session::flash('biaya', $request->biaya);

        $request->validate([
            'id_buku' => 'required|numeric|unique:buku,id_buku',
            'judul' => 'required',
            'pengarang' => 'required',
            'biaya' => 'required',
        ], [
            'id_buku.required' => 'ID buku wajib diisi',
            'id_buku.numeric' => 'ID buku wajib berupa angka',
            'id_buku.unique' => 'ID buku sudah ada',
            'judul.required' => 'Judul buku wajib diisi',
            'pengarang.required' => 'Nama pengarang buku wajib diisi',
            'biaya.required' => 'Biaya buku wajib diisi',

        ]);
        $data = [
            'id_buku' => $request->id_buku,
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'biaya' => $request->biaya,
        ];
        buku::create($data);
        return redirect()->to('/')->with('success', 'Berhasil menambahkan data buku');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = buku::where('id_buku', $id)->first();
        return view('buku.edit')->with('data', $data);
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
        $request->validate([
            'judul' => 'required',
            'pengarang' => 'required',
            'biaya' => 'required',
        ], [
            'judul.required' => 'Judul buku wajib diisi',
            'pengarang.required' => 'Nama pengarang buku wajib diisi',
            'biaya.required' => 'Biaya buku wajib diisi',
        ]);
        $data = [
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'biaya' => $request->biaya,
        ];
        buku::where('id_buku', $id)->update($data);
        return redirect()->to('/')->with('success', 'Berhasil update data buku');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        buku::where('id_buku', $id)->delete();
        return redirect()->to('buku')->with('success', 'Berhasil menghapus data buku');
    }
}
