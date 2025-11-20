@extends('layouts.app')
@section('title','Booking Meja')
@section('content')
<div class="container fade-up">
  <div class="hero-card">
    <h2 class="section-title">Reservasi Meja</h2>
    <form action="{{ url('/booking') }}" method="POST" style="margin-top:12px;">
      @csrf
      <div style="display:grid; gap:12px; max-width:560px;">
        <input name="nama" placeholder="Nama lengkap" required class="input-field">
        <input name="tanggal" type="date" required class="input-field">
        <input name="waktu" type="time" required class="input-field">
        <input name="jumlah" type="number" min="1" placeholder="Jumlah orang" required class="input-field">
        <button class="btn btn-order" type="submit">Kirim Reservasi</button>
      </div>
    </form>
  </div>
</div>
@endsection
