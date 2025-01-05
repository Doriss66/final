<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";  
  document.getElementById("main-content").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft = "0";  
  document.getElementById("main-content").style.marginLeft = "0";
}
function showProjectItems() {
  // Option 1: Using jQuery (if you're using jQuery)
  $.ajax({
    url: "./adminView/viewAllProjects.php", 
    type: "POST", 
    data: {}, 
    success: function(response) {
      $('.allContent-section').html(response); 
    },
    error: function() {
      alert("Error fetching project data.");
    }
  });

  // Option 2: Using plain JavaScript (if not using jQuery)
  // Fetch the data using XMLHttpRequest (more advanced)
  /*
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "./adminView/viewAllProjects.php", true);
  xhr.onload = function() {
    if (xhr.status === 200) {
      document.querySelector('.allContent-section').innerHTML = xhr.responseText;
    } else {
      alert("Error fetching project data.");
    }
  };
  xhr.send();
  */
}