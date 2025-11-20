<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>Cozy Cafe — @yield('title', 'Home')</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

  <!-- main css -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <meta name="theme-color" content="#2e1f18">
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
        <li><a href="{{ url('/') }}#menu">Menu</a></li>
        <li><a href="{{ url('/') }}#best">Best Seller</a></li>
        <li><a href="{{ url('/booking') }}">Booking</a></li>
        <li><a href="{{ url('/contact') }}">Contact</a></li>
      </ul>
      <button class="btn btn-order">Order</button>
      <button class="nav-toggle" id="navToggle" aria-label="Toggle menu">☰</button>
    </div>
  </nav>

  <main>
    @yield('content')
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

    // smooth scroll for internal anchors
    document.querySelectorAll('a[href^="#"]').forEach(a=>{
      a.addEventListener('click', e=>{
        e.preventDefault();
        const target = document.querySelector(a.getAttribute('href'));
        if(target) target.scrollIntoView({behavior:'smooth', block:'start'});
      });
    });

    // simple fade-in on scroll (IntersectionObserver)
    const io = new IntersectionObserver((entries)=>{
      entries.forEach(e=>{
        if(e.isIntersecting) { e.target.classList.add('inview'); io.unobserve(e.target); }
      });
    }, {threshold: 0.12});
    document.querySelectorAll('.fade-up').forEach(el => io.observe(el));
  </script>
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

</body>
</html>
