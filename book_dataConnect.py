from flask import Flask, render_template
import mysql.connector

app = Flask(__name__)

def get_db_connection():
    connection = mysql.connector.connect(
        host="localhost", 
        user="root",  
        password="",  
        database="lms1"  
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