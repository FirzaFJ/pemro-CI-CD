@extends('layouts.main')

@section('container')
    <div class="row justify-content-center vh-100">
        <div class="col-md-10">
            <h1 class="mt-3 mb-4 text-center">Manajemen Tugas Kuliah</h1>

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Tugas
                </div>
                <div class="card-body">

                    <!-- Button Tambah Tugas -->
                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Tambah Tugas
                    </button>

                    <form action="/logout" method="post" class="d-inline">
                        @csrf
                        <button class="btn btn-danger mb-2">Logout</button>
                    </form>
                    <div class="position-absolute top-0 end-0 pt-2 pe-3">{{ $date }}</div>

                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Matkul</th>
                                <th scope="col">Tugas</th>
                                <th scope="col">Deadline</th>
                                {{-- <th>status</th> --}}
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tugass as $tugas)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $tugas->matkul }}</td>
                                <td>{{ $tugas->judul_tugas }}</td>
                                {{-- Countdown --}}
                                <?php
                                    $end_time = strtotime("$tugas->deadline_date_tugas. $tugas->deadline_time_tugas"); // Countdown end time
                                    $current_time = time(); // Current timestamp
                                    $time_left = $end_time - $current_time; // Time remaining in seconds

                                    $days = floor($time_left / 86400); // 86400 seconds in a day
                                    $time_left = $time_left % 86400;

                                    $hours = floor($time_left / 3600 - 7); // 3600 seconds in an hour
                                    $time_left = $time_left % 3600;

                                    $minutes = floor($time_left / 60 + 1); // 60 seconds in a minute
                                    $seconds = $time_left % 60;
                                    // echo "$days days, $hours hours, $minutes minutes, and $seconds seconds.";
                                ?>
                                {{-- End Countdown --}}

                                @if ($days && $hours && $minutes <= 0 && $tugas->selesai ==1)
                                    <td>Tugas Selesai</td>
                                @elseif ($tugas->selesai==1)
                                    <td>Tugas Selesai</td>
                                @elseif ($days && $hours && $minutes && $seconds <= 0)
                                    <td>Terlamabat</td>
                                @else
                                    <td>{{ "$days hari, $hours jam, $minutes menit." }}</td>
                                @endif

                                {{-- @if ($tugas->selesai == "0")
                                    <td>Belum Selesai</td>
                                @else
                                    <td>Selesai</td>
                                @endif --}}
                                <td>
                                    <a href="/tugas/{{ $tugas->id }}/view" class="fs-6 btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="/tugas/{{ $tugas->id }}/edit" class="fs-6 btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    <form action="/tugas/{{ $tugas->id }}/delete" method="post" class="d-inline">
                                        @csrf
                                          <button class="fs-6 btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus {{ $tugas->judul_tugas }} matkul {{ $tugas->matkul }} ?')">
                                            <i class="fas fa-trash-alt"></i>
                                          </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


<!-- Modal Tambah Tugas -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background: linear-gradient(to bottom, #99ccff 0%, #ccff99 100%)">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Tugas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/tugas" method="post">
                @csrf
                  {{-- matkul --}}
                  <div class="form-floating mb-3">
                    <input type="text" name="matkul" class="form-control @error('matkul') is-invalid @enderror" id="matkul" placeholder="Mata Kuliah" required value="{{ old('matkul') }}">
                    <label for="matkul">Mata Kuliah</label>
                    @error('matkul')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  {{-- end matkul --}}

                  {{-- judul tugas --}}
                  <div class="form-floating mb-3">
                    <input type="text" name="judul_tugas" class="form-control @error('judul_tugas') is-invalid @enderror" id="judul_tugas" placeholder="Judul Tugas" required value="{{ old('judul_tugas') }}">
                    <label for="judul_tugas">Judul Tugas</label>
                    @error('judul_tugas')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  {{-- end judul tugas --}}

                  {{-- deskripsi  tugas--}}
                  <div class="mb-3">
                    <label for="deskripsi_tugas" class="form-label">Deskripsi Tugas</label>
                    @error('deskripsi_tugas')
                      <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input id="deskripsi_tugas" type="hidden" name="deskripsi_tugas" value="{{ old('deskripsi_tugas') }}">
                    <trix-editor input="deskripsi_tugas"></trix-editor>
                  </div>
                  {{-- end deskripsi tugas --}}

                  <div class="row">
                    {{-- Jenis Tugas --}}
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" name="jenis_tugas" class="form-control @error('jenis_tugas') is-invalid @enderror" id="jenis_tugas" placeholder="Jenis Tugas" required value="{{ old('jenis_tugas') }}">
                            <label for="jenis_tugas">Jenis Tugas</label>
                            @error('jenis_tugas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    {{-- End Jenis Tugas --}}

                    {{-- Deadline Tugas --}}
                    <div class="col">
                        <div class="row g-2">
                            <div class="col-md">
                                {{-- date --}}
                                <div class="form-floating mb-3">
                                    <input type="date" name="deadline_date_tugas" class="form-control @error('deadline_date_tugas') is-invalid @enderror" id="deadline_date_tugas" placeholder="Deadline Tugas" required value="{{ old('deadline_date_tugas') }}">
                                    <label for="deadline_date_tugas">Deadline Tugas</label>
                                    @error('deadline_date_tugas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md">
                                {{-- time --}}
                                <div class="form-floating mb-3">
                                    <input type="time" name="deadline_time_tugas" class="form-control @error('deadline_time_tugas') is-invalid @enderror" id="deadline_time_tugas" placeholder="Deadline Tugas" required value="{{ old('deadline_time_tugas') }}">
                                    <label for="deadline_time_tugas">Deadline Tugas</label>
                                    @error('deadline_time_tugas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                          </div>
                    </div>
                    {{-- End Deadline Tugas --}}
                  </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
    </form>
    </div>
    </div>
</div>
