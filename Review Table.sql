CREATE TABLE Review (
    ReviewID INT AUTO_INCREMENT PRIMARY KEY,
    BookID INT NOT NULL,
    UserID INT NOT NULL,
    Rating INT NOT NULL,
    Comment VARCHAR(500),
    ReviewDate DATE NOT NULL,
    CONSTRAINT FK_BookID_Review FOREIGN KEY (BookID) REFERENCES Books(BookID),
    CONSTRAINT FK_UserID_Review FOREIGN KEY (UserID) REFERENCES Users(UserID)
);