@extends('layouts.main')

@section('container')
<div class="row justify-content-center vh-100">
    <div class="col-md-8">
        <h3 class="text-center mt-3">Detail Tugas</h3>

        <table class="table table-info table-striped">
            {{-- <tr>
                <td colspan="2" class="text-center">
                    <img src="https://source.unsplash.com/1200x400?{{ $tugas->matkul }}" alt="" class="col-sm-5 img-fluid"
                        style="max-height: 250px">
                </td>
            </tr> --}}
            <tr>
                <td colspan="2" class="text-center">
                    <img src="https://source.unsplash.com/1200x400?{{ $tugas->matkul }}" class="col-sm-5 img-fluid" style="max-height: 250px">
                </td>
            </tr>

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <tr>
                <th class="text-end">Mata Kuliah: </th>
                <td>{{ $tugas->matkul }}</td>
            </tr>
            <tr>
                <th class="text-end">Judul Tugas: </th>
                <td>{{ $tugas->judul_tugas }}</td>
            </tr>
            <tr>
                <th class="text-end">Deskripsi Tugas: </th>
                <td>{!! $tugas->deskripsi_tugas !!}</td>
            </tr>
            <tr>
                <th class="text-end">Jenis Tugas: </th>
                <td>{{ $tugas->jenis_tugas }}</td>
            </tr>
            <tr>
                <th class="text-end">Deadline Tugas: </th>
                <td>{{ $tugas->deadline_date_tugas. " ". $tugas->deadline_time_tugas }}</td>
            </tr>
            <tr>
                <th class="text-end">Status: </th>
                @if ($tugas->selesai == "0")
                    <td>Belum Selesai</td>
                @else
                    <td>Selesai</td>
                @endif
            </tr>
            <tr>
                <th>
                    <a href="/tugas" class="btn btn-primary btn-sm">Kembali</a>
                    @if ($tugas->selesai == "0")
                        <form action="/tugas/{{ $tugas->id }}/selesai" method="post" class="d-inline">
                            @csrf
                            <button class="btn btn-success btn-sm">Selesai</button>
                        </form>
                    @endif
                </th>
                <td></td>

            </tr>
        </table>
    </div>
</div>
@endsection
