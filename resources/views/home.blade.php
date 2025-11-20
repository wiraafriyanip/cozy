@extends('layouts.app')

@section('title','Selamat Datang')

@section('content')
<div class="container">

  <!-- HERO -->
  <section id="home" class="hero fade-up">
    <div class="hero-card fade-up">
      <h1>Selamat Datang di Cozy Cafe</h1>
      <p>Nikmati secangkir kopi, suasana hangat, dan roti panggang yang baru matang. Cozy & calm — tempat cocok buat santai atau kerja.</p>
      <div style="display:flex; gap:12px; margin-top:12px;">
        <a href="#menu" class="btn btn-order">Lihat Menu</a>
        <a href="{{ url('/booking') }}" class="btn btn-ghost">Booking</a>
      </div>
    </div>

    <div class="hero-media fade-up">
      <img src="https://images.unsplash.com/photo-1504754524776-8f4f37790ca0?w=1200&q=80&auto=format&fit=crop" alt="Suasana Cozy Cafe">
    </div>
  </section>

  <!-- MENU SECTION -->
  <section id="menu" class="menu-section fade-up">
    <div class="section-title">Recommended Menu</div>
    <div class="menu-cards">
      <div class="card fade-up"
           data-img="https://images.unsplash.com/photo-1510626176961-4b57d4fbad03?w=900&q=80&auto=format&fit=crop"
           data-name="Caramel Macchiato"
           data-desc="Campuran espresso, susu, dan karamel yang creamy."
           data-price="Rp 28.000">
        <img src="https://images.unsplash.com/photo-1510626176961-4b57d4fbad03?w=900&q=80&auto=format&fit=crop" alt="">
        <h3>Caramel Macchiato</h3>
        <p>Campuran espresso, susu, dan karamel yang creamy.</p>
      </div>

      <div class="card fade-up"
           data-img="https://images.unsplash.com/photo-1587049352851-8eebc1b59e8d?w=900&q=80&auto=format&fit=crop"
           data-name="Matcha Latte"
           data-desc="Rasa matcha lembut dengan foam susu yang rich."
           data-price="Rp 26.000">
        <img src="https://images.unsplash.com/photo-1587049352851-8eebc1b59e8d?w=900&q=80&auto=format&fit=crop" alt="">
        <h3>Matcha Latte</h3>
        <p>Rasa matcha lembut dengan foam susu yang rich.</p>
      </div>

      <div class="card fade-up"
           data-img="https://images.unsplash.com/photo-1565958011705-44e211b59bb0?w=900&q=80&auto=format&fit=crop"
           data-name="Croissant Butter"
           data-desc="Roti lembut, wangi, dan pas buat teman ngopi."
           data-price="Rp 18.000">
        <img src="https://images.unsplash.com/photo-1565958011705-44e211b59bb0?w=900&q=80&auto=format&fit=crop" alt="">
        <h3>Croissant Butter</h3>
        <p>Lembut, wangi, dan pas buat teman ngopi.</p>
      </div>
    </div>
  </section>

  <!-- BEST SELLER -->
  <section id="best" class="best-seller fade-up">
    <div>
      <h2 class="section-title">Drink Best Seller</h2>
      <div class="food-list">
        <div class="food-item fade-up card"
             data-img="https://images.unsplash.com/photo-1512568400610-62da28bc8a13?w=800&q=80&auto=format&fit=crop"
             data-name="Vanilla Latte"
             data-desc="Espresso lembut dengan aroma vanilla yang manis."
             data-price="Rp 27.000">
          <img src="https://images.unsplash.com/photo-1512568400610-62da28bc8a13?w=800&q=80&auto=format&fit=crop" alt="">
          <div><strong>Vanilla Latte</strong><div>Espresso lembut dengan aroma vanilla yang manis.</div></div>
        </div>

        <div class="food-item fade-up card"
             data-img="https://images.unsplash.com/photo-1603398749949-bdb25cba4cc8?w=800&q=80&auto=format&fit=crop"
             data-name="Chocolate Cream Latte"
             data-desc="Rasa coklat creamy dan lembut."
             data-price="Rp 30.000">
          <img src="https://images.unsplash.com/photo-1603398749949-bdb25cba4cc8?w=800&q=80&auto=format&fit=crop" alt="">
          <div><strong>Chocolate Cream Latte</strong><div>Rasa coklat creamy dan lembut.</div></div>
        </div>
      </div>
    </div>

    <div>
      <h2 class="section-title">Food Best Seller</h2>
      <div class="food-list">
        <div class="food-item fade-up card"
             data-img="https://images.unsplash.com/photo-1604908177522-040a33aafaa3?w=800&q=80&auto=format&fit=crop"
             data-name="Croissant Butter"
             data-desc="Renyah di luar, lembut di dalam."
             data-price="Rp 18.000">
          <img src="https://images.unsplash.com/photo-1604908177522-040a33aafaa3?w=800&q=80&auto=format&fit=crop" alt="">
          <div><strong>Croissant Butter</strong><div>Renah luar, lembut di dalam.</div></div>
        </div>

        <div class="food-item fade-up card"
             data-img="https://images.unsplash.com/photo-1601972599720-038ff9a99a5f?w=800&q=80&auto=format&fit=crop"
             data-name="Choco Lava Cake"
             data-desc="Kue hangat dengan lelehan coklat di dalamnya."
             data-price="Rp 22.000">
          <img src="https://images.unsplash.com/photo-1601972599720-038ff9a99a5f?w=800&q=80&auto=format&fit=crop" alt="">
          <div><strong>Choco Lava Cake</strong><div>Hangat dengan lelehan coklat.</div></div>
        </div>

        <div class="food-item fade-up card"
             data-img="https://images.unsplash.com/photo-1590080875832-6a50d1d35e60?w=800&q=80&auto=format&fit=crop"
             data-name="Cheesy Garlic Bread"
             data-desc="Roti gurih dengan lelehan keju dan aroma bawang putih."
             data-price="Rp 20.000">
          <img src="https://images.unsplash.com/photo-1590080875832-6a50d1d35e60?w=800&q=80&auto=format&fit=crop" alt="">
          <div><strong>Cheesy Garlic Bread</strong><div>Roti gurih + lelehan keju.</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- TESTIMONI -->
  <section id="testimonials" class="testimonials fade-up center mt-6">
    <div class="section-title center">Komentar Pelanggan</div>
    <div class="testimonial">
      <div class="quote">“Tempat nyaman & kopinya top!”</div>
      <p>— Rina</p>
    </div>
    <div class="testimonial">
      <div class="quote">“Suasana hangat, cocok buat nugas.”</div>
      <p>— Dimas</p>
    </div>
  </section>

  <div class="mt-6 center">
    <a class="btn btn-order" href="{{ url('/booking') }}">Booking Sekarang</a>
  </div>

</div>

<!-- MODAL DETAIL PRODUK -->
<div id="menuModal" class="modal-overlay">
  <div class="modal-box fade-up">
    <button class="close-btn">×</button>
    <img id="modalImg" alt="Foto produk">
    <h3 id="modalTitle"></h3>
    <p id="modalDesc"></p>
    <p id="modalPrice" class="price"></p>
  </div>
</div>

<!-- SCRIPT POPUP -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('menuModal');
  const closeBtn = document.querySelector('.close-btn');
  const modalImg = document.getElementById('modalImg');
  const modalTitle = document.getElementById('modalTitle');
  const modalDesc = document.getElementById('modalDesc');
  const modalPrice = document.getElementById('modalPrice');

  document.querySelectorAll('.card').forEach(card => {
    card.addEventListener('click', () => {
      modalImg.src = card.dataset.img;
      modalTitle.textContent = card.dataset.name;
      modalDesc.textContent = card.dataset.desc;
      modalPrice.textContent = card.dataset.price;
      modal.classList.add('show');
    });
  });

  closeBtn.addEventListener('click', () => modal.classList.remove('show'));
  modal.addEventListener('click', e => {
    if (e.target === modal) modal.classList.remove('show');
  });
});
</script>
@endsection
