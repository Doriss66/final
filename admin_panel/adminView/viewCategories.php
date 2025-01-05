

<div>
  <h3>Project Domains</h3>
  <?php
     
      include_once(__DIR__ . '/../config/dbconnect.php');
      if (isset($_GET['message'])) {
          $message = $_GET['message'];
          if ($message == "success") {
              echo '<div class="alert alert-success">Category added successfully!</div>';
          } elseif ($message == "error_empty") {
              echo '<div class="alert alert-danger">Category name cannot be empty.</div>';
          } elseif ($message == "error_sql") {
              echo '<div class="alert alert-danger">Failed to add category. Please try again.</div>';
          }
      }
  ?>
  <table class="table">
    <thead>
      <tr>
        <th class="text-center">S.N.</th>
        <th class="text-center">Domain Name</th>
        <th class="text-center">Action</th>
      </tr>
    </thead>
    <?php
      include_once(__DIR__ . '/../config/dbconnect.php');
    
    
     
      $sql = "SELECT * FROM category"; // Assurez-vous que la table s'appelle 'category'
      $result = $conn->query($sql);
      $count = 1;
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
    ?>
    <tr>
      <td><?=$count?></td>
      <td><?=htmlspecialchars($row["category_name"])?></td> <!-- Changer de 'domain_name' à 'category_name' -->
      <td>
  <button class="btn btn-danger" style="height:40px" onclick="categoryDelete(<?=$row['category_id']?>)">Delete</button>
</td>

    </tr>
    <?php
          $count++;
        }
      }
    ?>
  </table>

  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-secondary" style="height:40px" data-toggle="modal" data-target="#myModal">
    Add Domain
  </button>
  <script>
  function addCategory() {
    // Récupérer la valeur du champ d'entrée
    const categoryName = document.querySelector('input[name="category_name"]').value;

    if (!categoryName.trim()) {
      alert("Please enter a category name.");
      return;
    }

    // Création de l'objet FormData pour envoyer les données
    const formData = new FormData();
    formData.append("category_name", categoryName);

    // Envoi de la requête AJAX
    fetch("http://localhost/admin_panel/controller/addCatController.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        alert(data); // Afficher le message retourné par le serveur
        if (data.includes("successfully")) {
          // Rafraîchir la liste des catégories si ajout réussi
          location.reload();
        }
      })
      .catch((error) => console.error("Error:", error));
  }
</script>
 <!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">New Domain</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form onsubmit="event.preventDefault(); addCategory();">
          <div class="form-group">
            <label for="category_name">Domain Name:</label>
            <input type="text" class="form-control" name="category_name" required>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-secondary" style="height:40px">Add Domain</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" style="height:40px">Close</button>
      </div>
    </div>
  </div>
</div>

