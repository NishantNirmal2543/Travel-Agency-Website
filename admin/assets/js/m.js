$(document).ready(function () {
  $(document).on("click", ".remove-btn", function () {
    $(this).closest("#itinerary-container").remove();
  });

  $(document).on("click", ".add-hotel-btn", function () {
    $(".paste-new-hotel").append(
      '<div class="form-outline mb-4 mt-4 " id="itinerary-container">\
            <label class="pt-3" for="name">Enter Hotel Name: </label>\
            <input type="text" name="name[]" class="form-control" required></input>\
            <label class="pt-3" for="image">Add Image</label>\
            <input type="file" name="image[]" class="form-control" required></input>\
            <label class="pt-3" for="description">Add Description</label>\
            <input type="text" name="description[]" class="form-control" required></input>\
            <button type="button" class="float-end remove-btn btn btn-danger m-3">Remove</button>\
        </div>'
    );
  });
});
