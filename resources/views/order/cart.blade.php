@extends('layouts.app')

@section('title','Keranjang Pesanan')

@section('content')
<div class="container fade-up">
  <div class="section-title">Keranjang Pesanan
    @if($table)
      - Meja {{ $table->kode_meja }}
    @endif
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  @if(empty($cart))
    <p>Keranjang masih kosong.</p>
  @else
    <form action="{{ route('order.cart.update') }}" method="POST">
      @csrf
      <table class="table">
        <thead>
          <tr>
            <th>Menu</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          @foreach($cart as $item)
            <tr>
              <td>{{ $item['nama'] }}</td>
              <td>Rp {{ number_format($item['harga'],0,',','.') }}</td>
              <td>
                <input type="number" name="quantities[{{ $item['menu_id'] }}]" 
                       value="{{ $item['jumlah'] }}" min="0" style="width:70px;">
              </td>
              <td>Rp {{ number_format($item['harga'] * $item['jumlah'],0,',','.') }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <p><strong>Total: Rp {{ number_format($total,0,',','.') }}</strong></p>

      <button type="submit" class="btn btn-order">Update Keranjang</button>
    </form>

    <form action="{{ route('order.checkout') }}" method="POST" style="margin-top:16px;">
      @csrf
      <button type="submit" class="btn btn-order">Kirim Pesanan</button>
    </form>
  @endif
</div>
@endsection
