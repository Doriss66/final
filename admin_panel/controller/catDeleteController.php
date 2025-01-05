<?php

    include_once "../config/dbconnect.php";
    
    // Récupérer et nettoyer l'ID de la catégorie
    $category_id = $_POST['record'];
    $category_id = mysqli_real_escape_string($conn, $category_id);  // Assurez-vous que l'ID est échappé
    $category_id = (int)$category_id;  // Convertir l'ID en entier pour éviter des problèmes

    // Vérification si l'ID est valide
    if($category_id <= 0) {
        echo "Invalid category ID";
        exit;
    }

    // Requête SQL pour supprimer la catégorie
    $query = "DELETE FROM category WHERE category_id = $category_id";

    // Exécution de la requête
    $data = mysqli_query($conn, $query);

    // Vérification si la suppression a réussi
    if ($data) {
        echo "Category Item Deleted";
    } else {
        echo "Not able to delete: " . mysqli_error($conn); // Afficher l'erreur si la requête échoue
    }
    
?>
