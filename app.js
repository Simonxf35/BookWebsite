const bookModel = require('./bookModel');

async function main() {
  // Create a new book
  const newBookId = await bookModel.createBook('The New Book', 'John Doe', 2022, 'Mystery', '1234567890');
  console.log(`New book created with ID: ${newBookId}`);

  // Get all books
  const allBooks = await bookModel.getAllBooks();
  console.log('All Books:', allBooks);

  // Get a book by ID
  const bookById = await bookModel.getBookById(newBookId);
  console.log('Book by ID:', bookById);

  // Update a book
  const updated = await bookModel.updateBook(newBookId, 'Updated Book Title', 'Jane Doe', 2023, 'Thriller', '0987654321');
  console.log('Book updated:', updated);

  // Delete a book
  const deleted = await bookModel.deleteBook(newBookId);
  console.log('Book deleted:', deleted);

  // Get all books after deletion
  const remainingBooks = await bookModel.getAllBooks();
  console.log('Remaining Books:', remainingBooks);
}

main();
