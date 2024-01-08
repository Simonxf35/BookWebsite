from flask import Flask, request, render_template
import mysql.connector

app = Flask(__name__)

def get_db_connection():
    connection = mysql.connector.connect(
        host="your_host",
        user="your_username",
        password="your_password",
        database="your_database_name"
    )
    return connection

# Connect to the MySQL server
connection = mysql.connector.connect(
    host="your_host",
    user="your_username",
    password="your_password",
    database="your_database_name"
)

@app.route('/books')
def show_books():
    connection = get_db_connection()
    cursor = connection.cursor()

    cursor.execute("SELECT id, title, author FROM books")
    books = cursor.fetchall()

    cursor.close()
    connection.close()

    return render_template('books.html', books=books)

if __name__ == "__main__":
    app.run(debug=True)