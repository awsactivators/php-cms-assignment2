document.addEventListener("DOMContentLoaded", function () {

  // View Details button in Index.php
 

  document.querySelectorAll(".view-details").forEach(button => {
      button.addEventListener("click", function () {
        document.getElementById("movieLanguage").innerText = this.dataset.language;
          document.getElementById("movieTitle").innerText = this.dataset.title;
          document.getElementById("movieImage").src = this.dataset.img;
          document.getElementById("movieDescription").innerText = this.dataset.description;
          document.getElementById("movieRelease").innerText = this.dataset.release;
          document.getElementById("movieBudget").innerText = this.dataset.budget;
          document.getElementById("movieRevenue").innerText = this.dataset.revenue;
          document.getElementById("movieRating").innerText = this.dataset.rating;
          document.getElementById("movieStudio").innerText = this.dataset.studio;
          document.getElementById("movieCountry").innerText = this.dataset.country;
          document.getElementById("movieYear").innerText = this.dataset.year;

        const movieModal = new bootstrap.Modal(document.getElementById("movieModal"));
        movieModal.show();


      });
  });


  // View Details button in admin.php
  document.querySelectorAll(".view-movie").forEach(button => {
    button.addEventListener("click", function () {
        document.getElementById("movieLanguage").innerText = this.dataset.language;
        document.getElementById("movieTitle").innerText = this.dataset.title;
        document.getElementById("movieImage").src = this.dataset.img;
        document.getElementById("movieDescription").innerText = this.dataset.description;
        document.getElementById("movieRelease").innerText = this.dataset.release;
        document.getElementById("movieBudget").innerText = this.dataset.budget;
        document.getElementById("movieRevenue").innerText = this.dataset.revenue;
        document.getElementById("movieRating").innerText = this.dataset.rating;
        document.getElementById("movieStudio").innerText = this.dataset.studio;
        document.getElementById("movieCountry").innerText = this.dataset.country;
        document.getElementById("movieYear").innerText = this.dataset.year;

        const movieModal = new bootstrap.Modal(document.getElementById("movieModal"));
        movieModal.show();
    });
  });




  // delete confirmation of movie
  const deleteMovieButtons = document.querySelectorAll(".delete-btn");
  const movieToDelete = document.getElementById("movieToDelete");
  const deleteMovieId = document.getElementById("deleteMovieId");

  deleteMovieButtons.forEach(button => {
      button.addEventListener("click", function() {
          const movieTitle = this.getAttribute("data-title");
          const movieId = this.getAttribute("data-id");

          movieToDelete.textContent = movieTitle; 
          deleteMovieId.value = movieId;
          
      });
  });


  
    // delete confirmation of admin
    const deleteAdminButtons = document.querySelectorAll('.dlt-btn');
    const usernameToDelete = document.getElementById('usernameToDelete');
    const deleteUserId = document.getElementById('deleteUserId');

    deleteAdminButtons.forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            const username = this.getAttribute('data-username');

            usernameToDelete.textContent = username;
            deleteUserId.value = userId;
          
        });
    });

});


