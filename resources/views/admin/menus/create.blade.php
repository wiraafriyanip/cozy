@extends('layouts.app')

@section('title','Tambah Menu')

@section('content')
<div class="container fade-up">
  <div class="section-title">Tambah Menu Baru</div>

  @if($errors->any())
    <div class="alert alert-danger">
      <ul style="margin:0;padding-left:16px;">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
      <label for="nama_menu" class="form-label">Nama Menu</label>
      <input type="text" name="nama_menu" id="nama_menu"
             class="form-control" value="{{ old('nama_menu') }}" required>
    </div>

    <div class="mb-3">
      <label for="kategori" class="form-label">Kategori</label>
      <input type="text" name="kategori" id="kategori"
             class="form-control" value="{{ old('kategori') }}"
             placeholder="makanan / minuman / snack">
    </div>

    <div class="mb-3">
      <label for="harga" class="form-label">Harga</label>
      <input type="number" name="harga" id="harga"
             class="form-control" value="{{ old('harga') }}"
             min="0" step="1000" required>
    </div>

    <div class="mb-3">
      <label for="deskripsi" class="form-label">Deskripsi</label>
      <textarea name="deskripsi" id="deskripsi" rows="3"
                class="form-control">{{ old('deskripsi') }}</textarea>
    </div>

    <div class="mb-3">
      <label for="gambar" class="form-label">Gambar</label>
      <input type="file" name="gambar" id="gambar" class="form-control">
      <small class="text-muted">Format: JPG, JPEG, PNG, WEBP. Maks 2MB.</small>
    </div>

    <div class="form-check mb-3">
      <input type="checkbox" name="is_available" id="is_available"
             class="form-check-input" checked>
      <label for="is_available" class="form-check-label">Tersedia</label>
    </div>

    <button type="submit" class="btn btn-order">Simpan</button>
    <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">Batal</a>
  </form>
</div>
@endsection
