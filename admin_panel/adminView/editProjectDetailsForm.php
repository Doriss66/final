<div class="container p-5">
    <h4>Edit Project Details</h4>
    <?php
        include_once "../config/dbconnect.php";
        $ID = $_POST['record'];
        $qry = mysqli_query($conn, "SELECT * FROM projects WHERE id='$ID'");
        $row1 = mysqli_fetch_assoc($qry); // Récupération directe des données associatives

        if ($row1) { // Vérification si un projet existe
    ?>
  
  <div id="editProjectModal" style="display:none;">
    <form id="update-Projects" onsubmit="return updateProjects();" enctype="multipart/form-data">
        <input type="hidden" id="project_id">
        <div class="form-group">
            <label for="p_title">Project Title:</label>
            <input type="text" class="form-control" id="p_title" required>
        </div>
        <div class="form-group">
            <label for="p_desc">Description:</label>
            <textarea class="form-control" id="p_desc" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="p_keywords">Keywords:</label>
            <input type="text" class="form-control" id="p_keywords" required>
        </div>
        <div class="form-group">
            <label for="p_tech">Technologies Used:</label>
            <input type="text" class="form-control" id="p_tech" required>
        </div>
        <div class="form-group">
            <label for="p_status">Status:</label>
            <select id="p_status" class="form-control" required>
                <option value="ouvert">Open</option>
                <option value="en cours">In Progress</option>
                <option value="terminé">Completed</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update Project</button>
        </div>
    </form>
</div>

</div>

    <?php
        } else {
            echo "<p class='text-danger'>No project found for the given ID.</p>";
        }
    ?>
</div>
