
<div>
  <h2>Project Items</h2>
  <table class="table">
    <thead>
      <tr>
        <th class="text-center">S.N.</th>
        <th class="text-center">Project Title</th>
        <th class="text-center">Project Description</th>
        <th class="text-center">Keywords</th>
        <th class="text-center">Technologies</th>
        <th class="text-center">Domain</th>
        <th class="text-center">Status</th>
        <th class="text-center" colspan="2">Action</th>
      </tr>
    </thead>
    <?php
    
    if (!isset($_GET['page']) || $_GET['page'] !== 'projects') {
      return; // Arrête l'exécution si la condition n'est pas remplie
  }
      include_once(__DIR__ . '/../config/dbconnect.php');
     
      $sql = "SELECT * FROM projects";
      $result = $conn->query($sql);
      $count = 1;
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
    ?>
    <tr>
      <td><?=$count?></td>
      <td><?=$row["project_id"]?></td>
      <td><?=$row["title"]?></td>
      <td><?=$row["description"]?></td>      
      <td><?=$row["keywords"]?></td> 
      <td><?=$row["technologies"]?></td>     
      <td><?=htmlspecialchars($row["category_id"])?>
      <td>
        <!-- Bouton Edit -->
        <button class="btn btn-primary" onclick="editProject(<?=$row['project_id']?>)">Edit</button>
    </td>
    <td>
        <!-- Bouton Delete -->
        <button class="btn btn-danger" onclick="deleteProject(<?=$row['project_id']?>)">Delete</button>
    </td>

    

   
    

    
      </tr>
      <?php
            $count=$count+1;
          }
        }
        
      ?>
  </table>
<!-- Modal pour l'édition -->
<div class="modal fade" id="editProjectModal" tabindex="-1" role="dialog" aria-labelledby="editProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProjectModalLabel">Edit Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editProjectForm">
                    <input type="hidden" id="edit_project_id" name="project_id">
                    <div class="form-group">
                        <label for="edit_title">Title</label>
                        <input type="text" class="form-control" id="edit_title" name="p_title" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_description">Description</label>
                        <textarea class="form-control" id="edit_description" name="p_desc" required></textarea>
                    </div>
                    <!-- Ajoutez d'autres champs ici si nécessaire -->
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>





  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-secondary" style="height:40px" data-toggle="modal" data-target="#myModal">
    Add Project
  </button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">New Project Item</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form id="addProjectForm" method="POST" enctype='multipart/form-data'>
            <div class="form-group">
              <label for="p_name">Project Title:</label>
              <input type="text" class="form-control" id="p_name" name="p_name" required>
            </div>
            <div class="form-group">
              <label for="p_desc">Description:</label>
              <input type="text" class="form-control" id="p_desc" name="p_desc" required>
            </div>
            <div class="form-group">
              <label for="p_keywords">Keywords:</label>
              <input type="text" class="form-control" id="p_keywords" name="p_keywords" required>
            </div>
            <div class="form-group">
              <label for="p_technologies">Technologies:</label>
              <input type="text" class="form-control" id="p_technologies" name="p_technologies" required>
            </div>
            <div class="form-group">
              <label>Domain:</label>
              <select id="category" name="category" required>
                <option disabled selected>Select domain</option>
                <?php
                // Fetch categories from the database
                $sql = "SELECT * FROM category";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                  echo "<option value='".$row['category_id']."'>".$row['category_name']."</option>";
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label>Status:</label>
              <select id="p_status" name="p_status" required>
                <option value="open">Open</option>
                <option value="in progress">In Progress</option>
                <option value="closed">Completed</option>
              </select>
            </div>
            <div class="form-group">
              <button type="button" class="btn btn-secondary"  style="height:40px" name="upload">Add Project</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" style="height:40px">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
