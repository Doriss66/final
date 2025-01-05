
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="./assets/js/script.js"></script>
</head>
<body>
    <?php
        include "./dashboard.php";  // Inclure le header admin
        include "./sidebar.php";     // Inclure le sidebar admin
    ?>
    
    <div id="main-content" class="container allContent-section py-4">
        <?php
            if (isset($_GET['page'])) {
                switch ($_GET['page']) {
                    case 'viewStudents':
                        include './adminView/studentsList.php';
                        break;
                    case 'viewTeachers':
                        include './adminView/teachersList.php';
                        break;
                    case 'viewProjects':
                        include './adminView/projectsList.php';
                        break;
                    case 'viewApplications':
                        include './adminView/applicationsList.php';
                        break;
                    case 'viewGroups':
                        include './adminView/groupsList.php';
                        break;
                    default:
                        echo "Page not found.";
                }
            } else {
                echo "Welcome to the Admin Dashboard!";
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
