const db = require('./db');

// Create a new book
async function createBook(title, author, publicationYear, genre, isbn) {
  const [rows] = await db.execute(
    'INSERT INTO books (title, author, publication_year, genre, isbn) VALUES (?, ?, ?, ?, ?)',
    [title, author, publicationYear, genre, isbn]
  );
  return rows.insertId;
}

// Get all books
async function getAllBooks() {
  const [rows] = await db.execute('SELECT * FROM books');
  return rows;
}

// Get a book by ID
async function getBookById(bookId) {
  const [rows] = await db.execute('SELECT * FROM books WHERE id = ?', [bookId]);
  return rows[0];
}

// Update a book by ID
async function updateBook(bookId, title, author, publicationYear, genre, isbn) {
  const [rows] = await db.execute(
    'UPDATE books SET title = ?, author = ?, publication_year = ?, genre = ?, isbn = ? WHERE id = ?',
    [title, author, publicationYear, genre, isbn, bookId]
  );
  return rows.affectedRows > 0;
}

// Delete a book by ID
async function deleteBook(bookId) {
  const [rows] = await db.execute('DELETE FROM books WHERE id = ?', [bookId]);
  return rows.affectedRows > 0;
}

module.exports = {
  createBook,
  getAllBooks,
  getBookById,
  updateBook,
  deleteBook,
};
