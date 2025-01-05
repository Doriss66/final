<?php
    include_once "../config/dbconnect.php";
    
    if (isset($_POST['upload'])) {

        
        // Récupération des données depuis le formulaire
        $ProjectTitle = $_POST['p_name'];
        $desc = $_POST['p_desc'];
        $category_id = $_POST['category'];

        // Validation de la présence des champs
        if (empty($ProjectTitle) || empty($desc) || empty($category_id)) {
            echo "All fields are required.";
            exit;
        }

        // Sécurisation des données
        $ProjectTitle = mysqli_real_escape_string($conn, $ProjectTitle);
        $desc = mysqli_real_escape_string($conn, $desc);
        $category_id = mysqli_real_escape_string($conn, $category_id);

        // Insertion dans la base de données
        $insert = mysqli_query($conn, "INSERT INTO projects (title, description, category_id) 
                                      VALUES ('$ProjectTitle', '$desc', '$category_id')");

        // Vérification de l'insertion
        if (!$insert) {
            echo "Error: " . mysqli_error($conn);  // Affichage d'un message d'erreur si l'insertion échoue
        } else {
            echo "Project added successfully.";
        }
    }
?>
