@extends('layouts.main')

@section('container')
    <div class="row justify-content-center vh-100">
        <div class="col-md-8 border">
            <h3 class="mt-3 mb-4 text-center">Edit Tugas</h3>

            <form action="/tugas/{{ $tugas->id }}" method="post">
                @csrf
                {{-- matkul --}}
                <div class="form-floating mb-3">
                    <input type="text" name="matkul" class="form-control @error('matkul') is-invalid @enderror" id="matkul" placeholder="Mata Kuliah" required value="{{ old('matkul', $tugas->matkul) }}">
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
                    <input type="text" name="judul_tugas" class="form-control @error('judul_tugas') is-invalid @enderror" id="judul_tugas" placeholder="Judul Tugas" required value="{{ old('judul_tugas', $tugas->judul_tugas) }}">
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
                    <input id="deskripsi_tugas" type="hidden" name="deskripsi_tugas" value="{{ old('deskripsi_tugas', $tugas->deskripsi_tugas) }}">
                    <trix-editor input="deskripsi_tugas"></trix-editor>
                  </div>
                  {{-- end deskripsi tugas --}}

                  <div class="row">
                    {{-- Jenis Tugas --}}
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" name="jenis_tugas" class="form-control @error('jenis_tugas') is-invalid @enderror" id="jenis_tugas" placeholder="Jenis Tugas" required value="{{ old('jenis_tugas', $tugas->jenis_tugas) }}">
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
                                    <input type="date" name="deadline_date_tugas" class="form-control @error('deadline_date_tugas') is-invalid @enderror" id="deadline_date_tugas" placeholder="Deadline Tugas" required value="{{ old('deadline_date_tugas', $tugas->deadline_date_tugas) }}">
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
                                    <input type="time" name="deadline_time_tugas" class="form-control @error('deadline_time_tugas') is-invalid @enderror" id="deadline_time_tugas" placeholder="Deadline Tugas" required value="{{ old('deadline_time_tugas', $tugas->deadline_time_tugas) }}">
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



                <div class="mb-3">
                    <a href="/tugas" class="btn btn-primary">Kembali</a>
                    <input type="submit" value="Edit" class="btn btn-warning">
                </div>
            </form>
        </div>
    </div>
@endsection
