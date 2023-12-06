CREATE TABLE Books (
    Title VARCHAR(50) NOT NULL,
    ISBN VARCHAR(50),
    Author VARCHAR(50) NOT NULL,
    Publisher VARCHAR(50),
    Chapters INT NOT NULL,
    Synopsis VARCHAR(500),
    Genre TEXT,
    Status VARCHAR(50), 
    TotalViews INT,
    AverageRating FLOAT
);