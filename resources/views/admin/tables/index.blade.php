@extends('layouts.app')

@section('title','Admin - Meja')

@section('content')
<div class="container fade-up">
  <div class="section-title">Kelola Meja &amp; QR</div>

 

  <a href="{{ route('admin.tables.create') }}" class="btn btn-order">
    Tambah Meja
  </a>

  <table class="table" style="margin-top:16px;">
    <thead>
      <tr>
        <th>ID</th>
        <th>Kode Meja</th>
        <th>Link Pemesanan</th>
        <th>QR Code</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($tables as $table)
        <tr>
          <td>#{{ $table->id }}</td>
          <td>{{ $table->kode_meja }}</td>
          <td>
            <small>
              {{ route('order.menu', ['kode_meja' => $table->kode_meja]) }}
            </small>
          </td>
          <td>
            {{-- QR code dari link order --}}
            <img
              src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data={{ urlencode(route('order.menu', ['kode_meja' => $table->kode_meja])) }}"
              alt="QR {{ $table->kode_meja }}"
              style="border-radius:8px;"
            >
          </td>
          <td>
            <form action="{{ route('admin.tables.destroy', $table->id) }}"
                  method="POST"
                  onsubmit="return confirm('Hapus meja ini?');"
                  style="display:inline-block;">
              @csrf
              @method('DELETE')
              <button type="submit">Hapus</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="5" class="text-center">
            Belum ada data meja.
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
