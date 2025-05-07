document.querySelectorAll('.star').forEach(star => {
  star.addEventListener('click', function () {
    // Get the rating value from the clicked star
    const rating = this.getAttribute('data-value');
    
    // Set the rating in the hidden input field
    document.getElementById('rating').value = rating;

    // Update the star colors to reflect the selected rating
    document.querySelectorAll('.star').forEach(s => {
      s.style.color = (s.getAttribute('data-value') <= rating) ? 'gold' : 'gray';
    });
  });
});
