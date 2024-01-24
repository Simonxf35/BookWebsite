CREATE TABLE Users (
    FirstName VARCHAR(100) NOT NULL,
    middleName VARCHAR(100),
    lastName VARCHAR(100) NOT NULL,
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE NOT NULL,
    emailAddress VARCHAR(255) NOT NULL,
    confirmEmail VARCHAR(255) NOT NULL,
    phone_number VARCHAR(50),
    user_password VARCHAR(100) NOT NULL,
    Interest INT NOT NULL
);
