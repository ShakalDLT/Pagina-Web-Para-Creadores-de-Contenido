
const avatar = document.getElementById('avatar');
const modal = document.getElementById('modal-upload');
const closeBtn = document.getElementById('close-modal');


avatar.addEventListener('click', () => {
  modal.style.display = 'flex';
});


closeBtn.addEventListener('click', () => {
  modal.style.display = 'none';
});


window.addEventListener('click', (e) => {
  if (e.target === modal) {
    modal.style.display = 'none';
  }
});
