function filterBooks() {
    const input = document.getElementById('searchInput').value.toLowerCase();
    const books = document.querySelectorAll('.book');
    
    books.forEach(book => {
        const title = book.getAttribute('data-title').toLowerCase();
        const author = book.getAttribute('data-author').toLowerCase();
        if (title.includes(input) || author.includes(input)) {
            book.style.display = 'block';
        } else {
            book.style.display = 'none';
        }
    });
}
