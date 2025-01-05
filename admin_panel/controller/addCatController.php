<?php
include_once "../config/dbconnect.php";

if (isset($_POST['category_name'])) {
    $catname = mysqli_real_escape_string($conn, $_POST['category_name']);

    if (empty($catname)) {
        echo "Category name cannot be empty.";
        exit;
    }

    // Vérification de la connexion à la base de données
    if (!$conn) {
        echo "Database connection failed: " . mysqli_connect_error();
        exit;
    }

    // Insertion de la catégorie dans la base de données
    $sql = "INSERT INTO category (category_name) VALUES ('$catname')";
    if (mysqli_query($conn, $sql)) {
        echo "Category added successfully.";
    } else {
        echo "Failed to add category: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
