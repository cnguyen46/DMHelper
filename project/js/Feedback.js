const stars = document.querySelectorAll('.star');
const submitBtn = document.getElementById('submitBtn');
const feedbackText = document.getElementById('feedbackText');

let selectedRating = 0;

// Star rating click handler
stars.forEach(star => {
  star.addEventListener('click', () => {
    selectedRating = parseInt(star.getAttribute('data-value'));

    stars.forEach(s => {
      if (parseInt(s.getAttribute('data-value')) <= selectedRating) {
        s.classList.add('selected');
      } else {
        s.classList.remove('selected');
      }
    });
  });
});

// Submit button handler
submitBtn.addEventListener('click', () => {
  alert(`Thank you for your feedback!`);
});
