document.addEventListener("DOMContentLoaded", function (event) {
  const showNavbar = (toggleId, navId, bodyId, headerId) => {
    const toggle = document.getElementById(toggleId),
      nav = document.getElementById(navId),
      bodypd = document.getElementById(bodyId),
      headerpd = document.getElementById(headerId);

    // Validate that all variables exist
    if (toggle && nav && bodypd && headerpd) {
      toggle.addEventListener("click", () => {
        // show navbar
        nav.classList.toggle("show");
        // change icon
        toggle.classList.toggle("bx-x");
        // add padding to body
        bodypd.classList.toggle("body-pd");
        // add padding to header
        headerpd.classList.toggle("body-pd");
      });
    }
  };

  showNavbar("header-toggle", "nav-bar", "body-pd", "header");

  /*===== LINK ACTIVE =====*/
  const linkColor = document.querySelectorAll(".nav_link");

  function colorLink() {
    if (linkColor) {
      linkColor.forEach((l) => l.classList.remove("active"));
      this.classList.add("active");
    }
  }
  linkColor.forEach((l) => l.addEventListener("click", colorLink));

  // Your code to run since DOM is loaded and ready
});

const formContainers = document.querySelectorAll(".form-container");
const navButtons = document.querySelectorAll('p[id^="btn-"]');

// Hide all forms initially
formContainers.forEach((container) => (container.style.display = "none"));

// Show the form corresponding to clicked button
navButtons.forEach((button) => {
  button.addEventListener("click", () => {
    const targetFormId = button.id.slice(4); // Remove "btn-" prefix
    formContainers.forEach((container) => {
      if (container.id === targetFormId) {
        container.style.display = "block";
      } else {
        container.style.display = "none";
      }
    });
  });
});

// add activity

$(document).ready(function () {
  $(document).on("click", ".remove-btn", function () {
    $(this).closest("#itinerary-container").remove();
  });

  $(document).on("click", ".add-activity-btn", function () {
    $(".add-new-forms").append(
      '<div class="form-outline mb-4 mt-4" id="itinerary-container">\
      <label for="activity_title">Activity Title</label>\
      <input type="text" name="activity_title[]" class="form-control" required></input>\
      <label for="activity_description">Activity Description</label>\
      <input rows="4" type="text" name="activity_description[]" class="form-control"\
          required></input>\
      <button type="button" class="float-end remove-btn btn btn-danger m-3">Remove</button>\
  </div>'
    );
  });
});

// add tours

$(document).ready(function () {
  $(document).on("click", ".remove-btn", function () {
    $(this).closest("#itinerary-container").remove();
  });

  $(document).on("click", ".add-day-btn", function () {
    $(".paste-new-forms").append(
      '<div class="form-outline mb-4 mt-4" id="itinerary-container">\
        <label for="day">Day </label>\
        <input type="text" name="day[]" class="form-control" required></input>\
        <label for="day_title">Day Title</label>\
        <input type="text" name="day_title[]" class="form-control" required></input>\
        <label for="day_description">Day Description</label>\
        <textarea type="text" name="day_description[]" class="form-control" required></textarea>\
        <button type="button" class="float-end remove-btn btn btn-danger m-3">Remove</button>\
    </div>'
    );
  });
});
