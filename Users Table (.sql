CREATE TABLE Users (
    FirstName VARCHAR(100) NOT NULL,
    middleName VARCHAR(100) NULL,
    lastName VARCHAR(100) NOT NULL,
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) UNIQUE NOT NULL,
    emailAddress VARCHAR(50) NOT NULL,
    comfirmEmail VARCHAR(50) NOT NULL,
    phone_number INT(50) NULL,
    user_password VARCHAR(100) NOT NULL,
    Interest INT AUTO_INCREMENT NOT NULL PRIMARY KEY
);