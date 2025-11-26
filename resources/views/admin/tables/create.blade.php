@extends('layouts.app')

@section('title','Tambah Meja')

@section('content')
<div class="container fade-up">
  <div class="section-title">Tambah Meja Baru</div>

  @if($errors->any())
    <div class="alert alert-danger">
      <ul style="margin:0;padding-left:16px;">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('admin.tables.store') }}" method="POST">
    @csrf

    <div class="mb-3">
      <label for="kode_meja" class="form-label">Kode Meja</label>
      <input
        type="text"
        name="kode_meja"
        id="kode_meja"
        class="form-control"
        value="{{ old('kode_meja') }}"
        required
      >
      <small class="text-muted">
        Contoh: M01, M02, VIP1, dsb. Kode harus unik.
      </small>
    </div>

    <button type="submit" class="btn btn-order">Simpan</button>
    <a href="{{ route('admin.tables.index') }}" class="btn btn-secondary">
      Batal
    </a>
  </form>
</div>
@endsection
