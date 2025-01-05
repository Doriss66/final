

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="./assets/js/script.js"></script>
</head>
<body>
    <?php
      
        include "./studentHeader.php";  // Inclure le header étudiant
        include "./sidebar.php";        // Inclure le sidebar étudiant
    ?>
    
    <div id="main-content" class="container allContent-section py-4">
        <?php
      
            // Vérifier quelle page l'étudiant veut afficher
            if (isset($_GET['page'])) {
                switch ($_GET['page']) {
                    case 'viewProjects':
                        // Inclure la page pour afficher les projets disponibles
                        include './studentView/viewAllProjects.php';
                        break;
                    case 'myApplications':
                        // Inclure la page pour afficher les applications de l'étudiant
                        include './studentView/myApplications.php';
                        break;
                    case 'profile':
                        // Inclure la page de profil étudiant
                        include './studentView/myProfile.php';
                        break;
                       
                    default:
                        // Si la page demandée n'est pas trouvée
                        echo "Page not found.";
                }
            } else {
                // Par défaut, afficher le tableau de bord ou la page d'accueil de l'étudiant
                echo "Welcome to your dashboard!";
            }
        ?>
    </div>
    
    <script type="text/javascript" src="./assets/js/ajaxWork.js"></script>    
    <script type="text/javascript" src="./assets/js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
