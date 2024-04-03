<?php
// Połączenie z bazą danych
$servername = "localhost";
$username = "username"; // twoje dane logowania do bazy danych
$password = "password";
$dbname = "myDB"; // nazwa twojej bazy danych

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

// Pobranie danych z formularza
$movie_title = $_POST['movie_title'];
$release_year = $_POST['release_year'];
$director = $_POST['director'];
$rating = $_POST['rating'];
$review = $_POST['review'];
$cover_image = $_FILES['cover_image']['name'];
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["cover_image"]["name"]);

// Przesłanie pliku na serwer
move_uploaded_file($_FILES["cover_image"]["tmp_name"], $target_file);

// Zapisanie recenzji do bazy danych
$sql = "INSERT INTO reviews (movie_title, release_year, director, rating, review, cover_image) 
        VALUES ('$movie_title', '$release_year', '$director', '$rating', '$review', '$cover_image')";

if ($conn->query($sql) === TRUE) {
    echo "Recenzja została dodana pomyślnie.";
} else {
    echo "Błąd: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
