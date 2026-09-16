@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<h1>
    Tambah User
    <small class="d-block">Buat akun user baru untuk mengakses sistem</small>
</h1>

<div class="form-card">
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        @include('users._form')
    </form>
</div>
@endsection