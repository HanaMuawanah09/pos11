@extends('layouts.app')

@section('title', 'Data Jenis')

@section('content')

    <div class="row align-items-center mb-3">
        <div class="col">
            <h1 class="mb-0">Data Jenis</h1>
        </div>
        <div class="col-auto">
            <a href="{{ route('jenis.create') }}" class="btn btn-primary">
                + Tambah Jenis
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th width="80">No</th>
                        <th>Nama Jenis</th>
                        <th width="220">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($jenis as $item)

                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $item->nama_jenis }}
                            </td>

                            <td>
                                <div class="d-flex gap-2">

                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('jenis.edit', $item->id) }}"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('jenis.destroy', $item->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Apakah kamu yakin ingin menghapus data ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>

                                    </form>

                                </div>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">
                                Belum ada data jenis.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>
        </div>
    </div>

@endsection