@extends('layouts.app')
@section('title','Contact')
@section('content')
<div class="container fade-up">
  <div class="hero-card">
    <h2 class="section-title">Hubungi Kami</h2>
    <p>Jl. Kenangan No.12 — Bukittinggi<br>Telp: +62 812-3456-7890</p>
    <form action="{{ url('/contact') }}" method="POST" style="margin-top:12px;">
      @csrf
      <div style="display:grid; gap:12px; max-width:680px;">
        <input name="nama" placeholder="Nama" required class="input-field">
        <input name="email" type="email" placeholder="Email" required class="input-field">
        <textarea name="pesan" rows="4" placeholder="Tulis pesan..." required class="input-field"></textarea>
        <button class="btn btn-order" type="submit">Kirim Pesan</button>
      </div>
    </form>
  </div>
</div>
@endsection
