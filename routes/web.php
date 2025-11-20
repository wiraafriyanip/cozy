<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Booking;

Route::get('/', function () { return view('home'); });
Route::get('/booking', function () { return view('booking'); });
Route::post('/booking', function(Request $r){
    // simple: store booking to DB (if migration exists) or flash message
    // validation minimal
    $r->validate([
      'nama'=>'required',
      'tanggal'=>'required|date',
      'waktu'=>'required',
      'jumlah'=>'required|integer|min:1'
    ]);
    // if Booking model exists:
    // \App\Models\Booking::create([...]);
    // For now redirect with message
    return back()->with('success','Reservasi berhasil dikirim! Terima kasih.');
});
Route::get('/contact', function () { return view('contact'); });
Route::post('/contact', function(Request $r){
    $r->validate(['nama'=>'required','email'=>'required|email','pesan'=>'required']);
    return back()->with('success','Pesan terkirim! Kami akan menghubungi Anda.');
});
Route::get('/menu', function () { return view('menu'); });
Route::get('/about', function () { return view('about'); });
