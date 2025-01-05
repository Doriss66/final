<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
console.log("ajaxWork.js is loaded!");

function showProjectItems(){  
    const url = "./adminView/viewAllProjects.php";
    $.ajax({
        url:url,
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}
function showProjects() {
    $.ajax({
        url: "./adminView/viewAllProjects.php",
        method: "get",
        success: function(data) {
            $('#project-list').html(data); // Assure-toi que la liste des projets a un ID `project-list`
        },
        error: function() {
            alert("Error loading projects.");
        }
    });
}

function addProject() {
    var title = $('#p_title').val();
    var description = $('#p_desc').val();
    var keywords = $('#p_keywords').val();
    var technologies = $('#p_tech').val();
    var status = $('#p_status').val();

    if (!title || !description || !keywords || !technologies || !status) {
        alert("All fields are required!");
        return;
    }

    var fd = new FormData();
    fd.append('p_name', title);
    fd.append('p_desc', description);
    fd.append('p_keywords', keywords);
    fd.append('p_tech', technologies);
    fd.append('p_status', status);

    $.ajax({
        url: "./controller/addProjectController.php",
        method: "post",
        data: fd,
        processData: false,
        contentType: false,
        success: function(data) {
            const response = JSON.parse(data); // Suppose que le serveur renvoie un JSON
            if (response.success) {
                alert(response.message);
                $('form').trigger('reset');
                showProjects(); // Rafraîchir la liste des projets
            } else {
                alert("Error: " + response.message);
            }
        },
        error: function() {
            alert("Error adding project.");
        }
    });
}

function editProjectForm(projectId) {
    console.log("Loading edit form for project ID:", projectId);

    $.ajax({
        url: './adminView/editProjectDetailsForm.php', // URL du fichier
        method: 'POST',
        data: { record: projectId }, // Envoie l'ID du projet
        success: function(response) {
            // Insère le contenu du formulaire dans une section de la page
            $('.allContent-section').html(response);
        },
        error: function(xhr, status, error) {
            console.error('Error loading edit project form:', status, error);
            alert('Failed to load edit form.');
        }
    });
}
function deleteProject(project_id) {
    if (confirm("Are you sure you want to delete this project?")) {
        $.ajax({
            url: "./controller/deleteProjectController.php",
            type: "POST",
            data: { project_id: project_id },
            success: function(response) {
                console.log("Response from server:", response); // Debug : affiche la réponse
                alert(response);
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error("Error deleting project:", error);
                alert("Something went wrong. Please try again.");
            }
        });
    }
}
function editProject(project_id) {
    $.ajax({
        url: "./controller/getProjectDetails.php",
        type: "POST",
        data: { project_id: project_id },
        success: function(response) {
            console.log("Response from server:", response); // Debug : affiche la réponse
            const project = JSON.parse(response);

            if (project.error) {
                alert(project.error);
            } else {
                $('#edit_project_id').val(project.project_id);
                $('#edit_title').val(project.title);
                $('#edit_description').val(project.description);
                $('#editProjectModal').modal('show');
            }
        },
        error: function(xhr, status, error) {
            console.error("Error loading project details:", error);
            alert("Something went wrong. Please try again.");
        }
    });
}


// Envoyer les modifications via AJAX
$('#editProjectForm').on('submit', function(e) {
    e.preventDefault();

    $.ajax({
        url: "./controller/updateProjectController.php", // Chemin vers le contrôleur PHP
        type: "POST",
        data: $(this).serialize(), // Récupère les données du formulaire
        success: function(response) {
            alert(response); // Affiche le message du serveur
            $('#editProjectModal').modal('hide'); // Ferme la modal
            location.reload(); // Recharge la page
        },
        error: function(xhr, status, error) {
            console.error("Error updating project:", error);
            alert("Something went wrong. Please try again.");
        }
    });
});








function categoryDelete(category_id) {
    if (confirm("Are you sure you want to delete this category?")) {
        $.ajax({
            url: "./adminView/catdeletecontroller.php", // Chemin vers votre contrôleur PHP
            type: "POST",
            data: { record: category_id },
            success: function(response) {
                alert(response); // Affiche le message de retour
                location.reload(); // Recharge la page pour actualiser les données
            },
            error: function(xhr, status, error) {
                console.error("An error occurred: " + error);
                alert("Something went wrong. Please try again.");
            }
        });
    }
}


function getProjectDetails(project_id) {
    $.ajax({
        url: './controller/getProjectDetails.php',  // Assure-toi que le fichier est bien ici
        method: 'POST',
        data: {project_id: project_id},  // Envoie l'ID du projet
        success: function(response) {
            var project = JSON.parse(response);
            
            // Si la réponse est correcte et contient les données du projet
            if (project) {
                $('#project_id').val(project.id);
                $('#p_title').val(project.titre);
                $('#p_desc').val(project.description);
                $('#p_keywords').val(project.mots_cles);
                $('#p_tech').val(project.technologies);
                $('#p_status').val(project.statut);
            } else {
                alert('No project details found.');
            }
        },
        error: function() {
            alert('Error fetching project details.');
        }
    });
}
//function editProject(projectId) {
  //  console.log("Edit button clicked for project ID:", projectId);

    // Appel AJAX pour récupérer les détails du projet
    //$.ajax({
      //  url: './controller/getProjectDetails.php', // Fichier PHP pour récupérer les détails
        ////method: 'POST',
        //data: { project_id: projectId }, // Envoie l'ID du projet
        //success: function(response) {
          //  console.log('Server response:', response); // Log de la réponse

            //try {
                // Parse la réponse JSON
              //  var project = JSON.parse(response);

                // Vérifie si une erreur est retournée
                //if (project.error) {
                  //  alert("Error: " + project.error);
                //} else {
                    // Remplit les champs du formulaire avec les données reçues
                  //$('#p_title').val(project.title);
                    //$('#p_desc').val(project.description);
                 //   $('#p_keywords').val(project.keywords);
                   // $('#p_technologies').val(project.technologies);
                    //$('#category').val(project.category_id);
                    //$('#p_status').val(project.status);

                    // Affiche le modal pour éditer
           //         $('#editProjectModal').modal('show');
             //   }
            //} catch (e) {
              //  console.error('Error parsing JSON:', e);
                //alert('An error occurred while processing the server response.');
            //}
        //},
        //error: function(xhr, status, error) {
          //  console.error('AJAX error:', status, error);
            //alert('Failed to fetch project details. Please try again.');
       // }
    //});
//}


//function deleteProject(projectId) {
  //  console.log("Delete button clicked for project ID:", projectId);

    //if (confirm('Are you sure you want to delete this project?')) {
        // Appel AJAX pour supprimer le projet
      //  $.ajax({
        //    url: './controller/deleteProjectController.php', // Fichier PHP pour la suppression
          //  method: 'POST',
            //data: { project_id: projectId }, // Envoie l'ID du projet
           // success: function(response) {
             //   console.log('Server response:', response); // Log de la réponse

               // if (response.trim() === 'true') {
                 //   alert('Project deleted successfully.');
                   // location.reload(); // Recharge la page pour voir les changements
               // } else {
                 //   alert('Error deleting project: ' + response);
              //  }
           // },
            //error: function(xhr, status, error) {
              //  console.error('AJAX error:', status, error);
                //alert('Failed to delete project. Please try again.');
            //}
        //});
    //}
//}

  

  //function updateProject() {
    //var formData = $('#editProjectForm').serialize(); // Sérialiser les données du formulaire
  
    //$.ajax({
      //url: 'updateprojectcontroller.php', // Le fichier PHP pour mettre à jour le projet
     // method: 'POST',
      //data: formData,
     // success: function(response) {
       // if (response === "true") {
         // alert("Project updated successfully");
          //location.reload(); // Recharger la page pour afficher les changements
       // } else {
         // alert("Error updating project: " + response);
       // }
      //},
      //error: function() {
       // alert("Error occurred while updating the project.");
      //}
    //});
  //}
  



