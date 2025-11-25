@extends('layouts.app')
@section('title','Menu')
@section('content')
<div class="container fade-up">
  <div class="section-title">
    Daftar Menu Cozy Cafe
    @if(isset($table) && $table)
      - Meja {{ $table->kode_meja }}
    @endif
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  @if($menus->isEmpty())
    <p>Belum ada menu yang tersedia.</p>
  @else
    <div class="menu-cards">
      @foreach($menus as $m)
        <div class="card">
          @php
            $imgPath = $m->gambar
              ? asset('storage/'.$m->gambar)
              : asset('images/menu-placeholder.jpg'); // siapkan gambar default ini
          @endphp

          <img src="{{ $imgPath }}" alt="{{ $m->nama_menu }}" class="menu-img">

          <h3>{{ $m->nama_menu }}</h3>
          <p><strong>Rp {{ number_format($m->harga,0,',','.') }}</strong></p>
          @if($m->deskripsi)
            <p>{{ $m->deskripsi }}</p>
          @endif

          <form action="{{ route('order.add') }}" method="POST" style="margin-top:8px;">
            @csrf
            <input type="hidden" name="menu_id" value="{{ $m->id }}">
            <div style="display:flex;align-items:center;gap:8px;">
              <label for="qty-{{ $m->id }}" style="margin:0;">Qty:</label>
              <input type="number" name="jumlah" id="qty-{{ $m->id }}"
                     value="1" min="1" style="width:80px;">
            </div>
            <button type="submit" class="btn btn-order" style="margin-top:8px;">
              Tambah ke Keranjang
            </button>
          </form>
        </div>
      @endforeach
    </div>

    <div style="margin-top:24px;">
      <a href="{{ route('order.cart') }}" class="btn btn-order">Lihat Keranjang</a>
    </div>
  @endif
</div>
@endsection
