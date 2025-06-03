const searchInput = document.getElementById('searchInput');
const noResults = document.getElementById('noResults');

searchInput.addEventListener('keyup', function() {
  const filter = this.value.toLowerCase();
  const rows = document.querySelectorAll('tbody tr');

  let visibleCount = 0;
  rows.forEach(row => {
    const text = row.textContent.toLowerCase();
    const isMatch = text.includes(filter);
    row.style.display = isMatch ? '' : 'none';
    if (isMatch) visibleCount++;
  });

  // Show or hide the "No users" message
  noResults.style.display = visibleCount === 0 ? 'block' : 'none';
});


