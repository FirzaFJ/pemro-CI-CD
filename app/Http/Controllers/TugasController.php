<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function index()
    {

        $date= date('D, d M Y');
        return view('index', [
            'title' => 'Dashboard',
            'active' => 'tugas',
            'tugass' => Tugas::where('user_id', auth()->user()->id)->get(),
            'date' => $date
        ]);
    }

    public function store(Request $request)
    {
        // return $request;
        $validateData= $request->validate([
            'matkul' => 'required',
            'judul_tugas' => 'required',
            'deskripsi_tugas' => 'required',
            'jenis_tugas' => 'required',
            'deadline_date_tugas' => 'required|date',
            'deadline_time_tugas' => 'required'
        ]);

        $validateData['deadline_time_tugas']= $validateData['deadline_time_tugas']. ":00";
        $validateData['selesai']= "0";
        $validateData['user_id']= auth()->user()->id;

        // return $validateData;
        Tugas::create($validateData);
        return redirect('/tugas')->with('success', 'Tugas Berhasil ditambahkan');
    }

    public function show(Tugas $tugas)
    {
        return view('view', [
            'title' => 'View Tugas',
            'tugas' => $tugas
        ]);
    }

    public function selesai(Tugas $tugas)
    {
        $validateData['selesai']= 1;
        Tugas::where('id', $tugas->id)->update($validateData);
        return redirect('/tugas/'. $tugas->id. '/view')->with('success', 'Tugas Selesai');
    }

    public function edit(Tugas $tugas)
    {
        return view('edit', [
            'title' => 'Edit Tugas',
            'tugas' => $tugas
        ]);
    }

    public function update(Request $request, Tugas $tugas)
    {
        // return $request;
        $validateData= $request->validate([
            'matkul' => 'required',
            'judul_tugas' => 'required',
            'deskripsi_tugas' => 'required',
            'jenis_tugas' => 'required',
            'deadline_date_tugas' => 'required|date',
            'deadline_time_tugas' => 'required'
        ]);

        Tugas::where('id', $tugas->id)->update($validateData);
        return redirect('/tugas')->with('success', 'Tugas Berhasil diedit');
    }

    public function destroy(Tugas $tugas)
    {
        Tugas::destroy($tugas->id);
        return redirect('/tugas')->with('success', 'Tugas berhasil dihapus!');
    }
}
