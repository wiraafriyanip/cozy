@extends('layouts.app')

@section('title','Pesanan Diterima')

@section('content')
<div class="container fade-up">
  <div class="section-title">Terima kasih!</div>

  @if($order->table)
    <p>Pesanan Anda untuk meja {{ $order->table->kode_meja }} telah diterima.</p>
  @endif

  <p>Nomor Pesanan: <strong>#{{ $order->id }}</strong></p>
  <p>Status awal: <strong>{{ ucfirst($order->status) }}</strong></p>

  <h3 style="margin-top:16px;">Rincian Pesanan:</h3>
  <ul>
    @foreach($order->items as $item)
      <li>
        {{ $item->menu->nama_menu }} x {{ $item->jumlah }}
        (Rp {{ number_format($item->subtotal,0,',','.') }})
      </li>
    @endforeach
  </ul>
  <p><strong>Total: Rp {{ number_format($order->total_harga,0,',','.') }}</strong></p>

  <p style="margin-top:16px;">
    Silakan lakukan pembayaran di <strong>kasir</strong> dengan menunjukkan
    nomor pesanan <strong>#{{ $order->id }}</strong>.
  </p>
  <p>
    Metode pembayaran yang tersedia:
    <strong>Tunai</strong>, <strong>QRIS</strong>, dan <strong>Kartu Debit</strong>.
  </p>
  <p style="margin-top:8px;">
    Setelah pembayaran diterima, kasir akan mengubah status pesanan Anda menjadi
    <strong>selesai</strong> di sistem.
  </p>
</div>
@endsection
