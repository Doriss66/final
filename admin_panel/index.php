<!DOCTYPE html>
<html>
<head>
  <title>Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./assets/css/style.css">
  <script src="./assets/js/script.js"></script>
  <script src="./path/to/your/javascript/file.js"></script>

</head>
<body>
    
<body>
    
    <?php
        include "./adminHeader.php";
        include "./sidebar.php";
        include_once "./config/dbconnect.php";
    ?>
   
   <div id="main-content" class="container allContent-section py-4">
        <div class="row">
            <!-- Total Students -->
<div class="col-sm-3">
    <div class="card">
        <i class="fa fa-users mb-2" style="font-size: 70px;"></i>
        <h4 style="color:white;">Total Students</h4>
        <h5 style="color:white;">
        <?php
            // Requête pour compter les étudiants dans la table 'users' avec le rôle 'student'
            $sql = "SELECT COUNT(*) AS total_students FROM users WHERE role = 'student'";
            $result = $conn->query($sql);
            if ($result) {
                $row = $result->fetch_assoc();
                echo $row['total_students'];
            } else {
                echo "Error: " . $conn->error;
            }
        ?>
        </h5>
    </div>
</div>

<!-- Total Categories -->
<div class="col-sm-3">
    <div class="card">
        <i class="fa fa-th-large mb-2" style="font-size: 70px;"></i>
        <h4 style="color:white;">Total Categories</h4>
        <h5 style="color:white;">
        <?php
            // Requête pour compter les catégories dans la table 'category'
            $sql = "SELECT COUNT(*) AS total_categories FROM category";
            $result = $conn->query($sql);
            if ($result) {
                $row = $result->fetch_assoc();
                echo $row['total_categories'];
            } else {
                echo "Error: " . $conn->error;
            }
        ?>
        </h5>
    </div>
</div>

<!-- Total Projects -->
<div class="col-sm-3">
    <div class="card">
        <i class="fa fa-th mb-2" style="font-size: 70px;"></i>
        <h4 style="color:white;">Total Projects</h4>
        <h5 style="color:white;">
        <?php
            // Requête pour compter les projets dans la table 'projects'
            $sql = "SELECT COUNT(*) AS total_projects FROM projects";
            $result = $conn->query($sql);
            if ($result) {
                $row = $result->fetch_assoc();
                echo $row['total_projects'];
            } else {
                echo "Error: " . $conn->error;
            }
        ?>
        </h5>
    </div>
</div>

           
           
        </div>
    </div>
   
    <?php

        // Affichage des alertes
        if (isset($_GET['category']) && $_GET['category'] == "success") {
            echo '<script> alert("Category Successfully Added")</script>';
        } else if (isset($_GET['category']) && $_GET['category'] == "error") {
            echo '<script> alert("Adding Unsuccess")</script>';
        }
        
        
        // Vérifier si une page est demandée via GET
        if (isset($_GET['page'])) {
            switch ($_GET['page']) {
                case 'dashboard':
                    // Inclure la sidebar et le contenu du dashboard
                   // include './sidebar.php'; // Sidebar pour le dashboard
                    echo "Page dashboard<br>";  // Test de message pour vérifier l'exécution
                    break;}
                    switch ($_GET['page']) {
                case 'projects':
                    // Inclure la page des projets (vérification si le fichier existe)
                    $file = './adminView/viewAllProjects.php';
                    if (file_exists($file)) {
                        include $file;  // Afficher la liste des projets
                    } else {
                        echo "Le fichier des projets n'a pas été trouvé.";
                    }
                    break;}
                    switch ($_GET['page']) {
                case 'category':
                    // Inclure la page des catégories
                    include './adminView/viewCategories.php';
                    break;
                default:
                    // Si la page demandée n'est pas trouvée
                    //echo "Page not found.";
            }
      
        
        } 
        
          ?>

  

    <script type="text/javascript" src="./assets/js/ajaxWork.js"></script>    
    <script type="text/javascript" src="./assets/js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
