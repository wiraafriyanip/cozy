@extends('layouts.app')

@section('title','Admin - Menu')

@section('content')
<div class="container fade-up">
  <div class="section-title">Kelola Menu</div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <a href="{{ route('admin.menus.create') }}" class="btn btn-order">Tambah Menu</a>

  <table class="table" style="margin-top:16px;">
    <thead>
      <tr>
        <th>Nama</th>
        <th>Gambar</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Tersedia</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($menus as $m)
        <tr>
          <td>{{ $m->nama_menu }}</td>
          <td>
            @if($m->gambar)
              <img src="{{ asset('storage/'.$m->gambar) }}"
                   alt="{{ $m->nama_menu }}"
                   style="max-width:60px;border-radius:6px;">
            @else
              <span class="text-muted">-</span>
            @endif
          </td>
          <td>{{ $m->kategori }}</td>
          <td>Rp {{ number_format($m->harga,0,',','.') }}</td>
          <td>{{ $m->is_available ? 'Ya' : 'Tidak' }}</td>
          <td>
            <a href="{{ route('admin.menus.edit',$m->id) }}">Edit</a>
            <form action="{{ route('admin.menus.destroy',$m->id) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" onclick="return confirm('Hapus menu?')">Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
