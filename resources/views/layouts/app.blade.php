<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>Cozy Cafe — @yield('title', 'Home')</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

  <!-- main css -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <meta name="theme-color" content="#2e1f18">

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-wood-dark text-cream">

  <nav class="site-nav">
    <div class="nav-inner">
      <a class="brand" href="{{ url('/') }}">
        <span class="brand-icon">☕</span>
        <span class="brand-text">Cozy Cafe</span>
      </a>

      <ul class="nav-links" id="navLinks">
        <li><a href="{{ url('/') }}#home">Home</a></li>
        <li><a href="{{ url('/menu') }}">Menu</a></li>
        <li><a href="{{ url('/') }}#best">Best Seller</a></li>
        <li><a href="{{ url('/booking') }}">Booking</a></li>
        <li><a href="{{ url('/contact') }}">Contact</a></li>

        @auth
            <li><a href="{{ route('admin.orders.index') }}">Admin</a></li>
            <li>
              <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn-link" style="background:none;border:none;color:inherit;cursor:pointer;">
                  Logout
                </button>
              </form>
            </li>
        @else
            <li><a href="{{ route('login') }}">Login</a></li>
        @endauth
      </ul>

      {{-- tombol ORDER langsung ke self-ordering meja M01 --}}
      <button class="btn btn-order"
              onclick="location.href='{{ route('order.menu', ['kode_meja' => 'M01']) }}'">
        Order
      </button>

      <button class="nav-toggle" id="navToggle" aria-label="Toggle menu">☰</button>
    </div>
  </nav>

  <main>
    {{-- konten halaman biasa --}}
    @yield('content')

    {{-- konten dari komponen Breeze (<x-app-layout>) --}}
    {{ $slot ?? '' }}
  </main>

  <footer class="site-footer">
    <div class="footer-inner">
      <div>
        <strong>Cozy Cafe</strong><br>
        ☕ since 2023
      </div>
      <div class="footer-actions">
        <button class="btn btn-ghost" onclick="location.href='{{ url('/booking') }}'">Booking</button>
      </div>
    </div>
  </footer>

  <script>
    // mobile nav
    const navToggle = document.getElementById('navToggle');
    const navLinks = document.getElementById('navLinks');
    navToggle?.addEventListener('click', ()=> navLinks.classList.toggle('open'));

    // smooth scroll untuk anchor (#menu, #best, dll)
    document.querySelectorAll('a[href^="#"]').forEach(a=>{
      a.addEventListener('click', e=>{
        e.preventDefault();
        const target = document.querySelector(a.getAttribute('href'));
        if(target) target.scrollIntoView({behavior:'smooth', block:'start'});
      });
    });

    // fade-in on scroll
    const io = new IntersectionObserver((entries)=>{
      entries.forEach(e=>{
        if(e.isIntersecting) { e.target.classList.add('inview'); io.unobserve(e.target); }
      });
    }, {threshold: 0.12});
    document.querySelectorAll('.fade-up').forEach(el => io.observe(el));
  </script>

  <script>
    // modal detail menu (kalau dipakai di home)
    document.addEventListener('DOMContentLoaded', () => {
      const modal = document.getElementById('menuModal');
      const closeBtn = document.querySelector('.close-btn');
      const modalImg = document.getElementById('modalImg');
      const modalTitle = document.getElementById('modalTitle');
      const modalDesc = document.getElementById('modalDesc');
      const modalPrice = document.getElementById('modalPrice');

      if (!modal) return;

      document.querySelectorAll('.card').forEach(card => {
        card.addEventListener('click', () => {
          modalImg.src = card.dataset.img;
          modalTitle.textContent = card.dataset.name;
          modalDesc.textContent = card.dataset.desc;
          modalPrice.textContent = card.dataset.price;
          modal.classList.add('show');
        });
      });

      if (closeBtn) {
        closeBtn.addEventListener('click', () => modal.classList.remove('show'));
      }
      modal.addEventListener('click', e => {
        if (e.target === modal) modal.classList.remove('show');
      });
    });
  </script>

  {{-- popup sukses (booking, tambah meja, dll) --}}
  @if (session('success'))
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: @json(session('success')),
          confirmButtonText: 'OK'
        });
      });
    </script>
  @endif
</body>
</html>
