$(document).ready(function () {
  $(document).on("click", ".remove-btn", function () {
    $(this).closest("#itinerary-container").remove();
  });

  $(document).on("click", ".add-feature1-btn", function () {
    $(".paste-new-feature1").append(
      ' <div class="form-outline mb-4 mt-4" id="itinerary-container">\
        <label for="vehicle_feature">Enter Feature</label>\
        <input type="text" name="vehicle_feature[]" class="form-control" required></input>\
        <button type="button" class="float-end remove-btn btn btn-danger m-3">Remove</button>\
    </div>'
    );
  });
});
