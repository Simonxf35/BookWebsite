CREATE TABLE Chapters (
    ChapterID INT AUTO_INCREMENT PRIMARY KEY,
    BookID INT NOT NULL,
    ChapterNumber INT NOT NULL,
    ChapterTitle VARCHAR(100) NOT NULL,
    Content TEXT,
    ReleaseDate DATE,
    CONSTRAINT FK_BookID_Chapters FOREIGN KEY (BookID) REFERENCES Books(BookID)
);   