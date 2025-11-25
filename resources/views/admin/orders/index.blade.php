@extends('layouts.app')

@section('title','Admin - Pesanan')

@section('content')
<div class="container fade-up">
  <div class="section-title">Daftar Pesanan</div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Meja</th>
        <th>Status</th>
        <th>Total</th>
        <th>Waktu</th>
        <th>Metode Bayar</th>
        <th>Detail</th>
        <th>Ubah Status & Pembayaran</th>
      </tr>
    </thead>
    <tbody>
      @foreach($orders as $order)
        <tr>
          <td>#{{ $order->id }}</td>
          <td>{{ $order->table->kode_meja ?? '-' }}</td>
          <td>{{ $order->status }}</td>
          <td>Rp {{ number_format($order->total_harga,0,',','.') }}</td>
          <td>{{ $order->created_at }}</td>
          <td>{{ $order->metode_bayar ?? '-' }}</td>
          <td>
            <ul style="padding-left:16px;">
              @foreach($order->items as $item)
                <li>{{ $item->menu->nama_menu }} x {{ $item->jumlah }}</li>
              @endforeach
            </ul>
          </td>
          <td>
            <form action="{{ route('admin.orders.updateStatus',$order->id) }}" method="POST">
              @csrf

              <div style="margin-bottom:4px;">
                <label for="status-{{ $order->id }}" style="display:block;font-size:12px;">Status</label>
                <select name="status" id="status-{{ $order->id }}">
                  @foreach(['baru','diproses','siap','selesai','batal'] as $st)
                    <option value="{{ $st }}" @if($order->status==$st) selected @endif>
                      {{ ucfirst($st) }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div style="margin-bottom:4px;">
                <label for="metode-{{ $order->id }}" style="display:block;font-size:12px;">Metode Bayar</label>
                <select name="metode_bayar" id="metode-{{ $order->id }}">
                  <option value="">-- Pilih --</option>
                  <option value="tunai" @if($order->metode_bayar=='tunai') selected @endif>Tunai</option>
                  <option value="qris" @if($order->metode_bayar=='qris') selected @endif>QRIS</option>
                  <option value="debit" @if($order->metode_bayar=='debit') selected @endif>Kartu Debit</option>
                </select>
              </div>

              <button type="submit" class="btn btn-order" style="margin-top:4px;">Simpan</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
