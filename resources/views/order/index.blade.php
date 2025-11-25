@extends('layouts.app')

@section('title','Order Meja '.$table->kode_meja)

@section('content')
<div class="container fade-up">
  <div class="section-title">
    Pemesanan Meja {{ $table->kode_meja }}
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <p style="margin-bottom:16px;">Silakan pilih menu dan tambahkan ke keranjang.</p>

  <div class="menu-cards">
    @foreach($menus as $m)
      <div class="card">
        @php
          $imgPath = $m->gambar
            ? asset('storage/'.$m->gambar)
            : asset('images/menu-placeholder.jpg');
        @endphp

        <img src="{{ $imgPath }}" alt="{{ $m->nama_menu }}" class="menu-img">

        <h3>{{ $m->nama_menu }}</h3>
        @if($m->deskripsi)
          <p>{{ $m->deskripsi }}</p>
        @endif
        <p><strong>Rp {{ number_format($m->harga,0,',','.') }}</strong></p>

        <form action="{{ route('order.add') }}" method="POST" style="margin-top:8px;">
          @csrf
          <input type="hidden" name="menu_id" value="{{ $m->id }}">
          <input type="number" name="jumlah" value="1" min="1" style="width:80px;">
          <button type="submit" class="btn btn-order">Tambah</button>
        </form>
      </div>
    @endforeach
  </div>

  <div style="margin-top:24px;">
    <a href="{{ route('order.cart') }}" class="btn btn-order">Lihat Keranjang</a>
  </div>
</div>
@endsection
