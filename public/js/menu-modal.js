document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('menuModal');
  const closeBtn = document.querySelector('.close-btn');
  const modalImg = document.getElementById('modalImg');
  const modalTitle = document.getElementById('modalTitle');
  const modalDesc = document.getElementById('modalDesc');
  const modalPrice = document.getElementById('modalPrice');

  // buat semua card bisa di-klik (baik gambar maupun area card)
  document.querySelectorAll('.card').forEach(card => {
    card.addEventListener('click', () => {
      modalImg.src = card.dataset.img;
      modalTitle.textContent = card.dataset.name;
      modalDesc.textContent = card.dataset.desc;
      modalPrice.textContent = "Harga: " + card.dataset.price;
      modal.classList.add('show');
    });
  });

  // tombol tutup
  closeBtn.addEventListener('click', () => modal.classList.remove('show'));

  // klik luar area modal = tutup
  modal.addEventListener('click', e => {
    if (e.target === modal) modal.classList.remove('show');
  });
});
