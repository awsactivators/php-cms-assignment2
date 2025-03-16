document.addEventListener("DOMContentLoaded", function () {
  let modal = new bootstrap.Modal(document.getElementById("movieModal"));

  document.querySelectorAll(".view-details").forEach(button => {
      button.addEventListener("click", function () {
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

          modal.show();
      });
  });
});
