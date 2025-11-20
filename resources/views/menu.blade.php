@extends('layouts.app')
@section('title','Menu')
@section('content')
<div class="container fade-up">
  <div class="section-title">Daftar Menu Cozy Cafe</div>

  <div class="menu-cards">
    <div class="card" 
         data-name="Caramel Macchiato" 
         data-img="{{ asset('') }}" 
         data-desc="Campuran espresso, susu, dan karamel yang creamy. Cocok dinikmati saat pagi hari dengan aroma kopi yang menenangkan."
         data-price="Rp 38.000">
      <img src="{{ asset('') }}" alt="Caramel Macchiato" class="menu-img">
      <h3>Caramel Macchiato</h3>
      <p>Espresso, susu, dan karamel yang creamy.</p>
    </div>

    <div class="card" 
         data-name="Matcha Latte" 
         data-img="{{ asset('images/matcha.jpg') }}" 
         data-desc="Rasa matcha lembut dengan foam susu yang rich dan aroma teh hijau yang menenangkan."
         data-price="Rp 35.000">
      <img src="{{ asset('images/matcha.jpg') }}" alt="Matcha Latte" class="menu-img">
      <h3>Matcha Latte</h3>
      <p>Rasa matcha lembut dengan foam susu.</p>
    </div>

    <div class="card" 
         data-name="Croissant Butter" 
         data-img="{{ asset('images/croissant.jpg') }}" 
         data-desc="Roti croissant lembut dan wangi, dipanggang setiap pagi dengan butter berkualitas tinggi."
         data-price="Rp 22.000">
      <img src="{{ asset('images/croissant.jpg') }}" alt="Croissant Butter" class="menu-img">
      <h3>Croissant Butter</h3>
      <p>Lembut dan buttery.</p>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal" id="menuModal">
  <div class="modal-content">
    <span class="close-btn">&times;</span>
    <img id="modalImg" src="" alt="">
    <h2 id="modalTitle"></h2>
    <p id="modalDesc"></p>
    <p id="modalPrice" class="modal-price"></p>
  </div>
</div>
@endsection
