from flask import Flask, render_template
import mysql.connector

app = Flask(__name__)

def get_db_connection():
    connection = mysql.connector.connect(
        host="your_host",  # Replace with your database host, e.g., "localhost" or an IP address
        user="your_username",  # Replace with your database username, e.g., "root"
        password="your_password",  # Replace with your database password
        database="your_database_name"  # Replace with your database name
    )
    return connection



@app.route('/books')
def show_books():
    connection = get_db_connection()
    cursor = connection.cursor()

    cursor.execute("SELECT * FROM Books")
    books = cursor.fetchall()

    cursor.close()
    connection.close()

    return render_template('books.html', books=books)


if __name__ == "__main__":
    app.run(debug=True)