$(document).ready(function(){
  // Show List on startup
  $("#single").hide();

  // Call function to show recipes on startup
  var orderBy = $("#orderBy").val();
  showAll(orderBy);

  // When selectbox is clicked, update list
  $("#orderBy").click(function(){
    orderBy = $("#orderBy").val();
    showAll(orderBy);
  });

  // Function that displays recipe list using AJAX call
  function showAll(orderBy){
    $(".info-container").remove();

    // AJAX call to show all recipes ordered by the sropdown list
    $.ajax({
      url: "Includes/Classes.php",
      type: "POST",
      data: {"callShowAll": orderBy},
      success: function(response){
        $("#list").append(response);

        // If recipe is clicked
        $(".info-container").on("click", function(){
          // Get ID of clicked element
          var ID = $(this).attr("ID");
          console.log(ID);

          // Hide list of recipes and show new element
          $("#list").hide();
          $("#single").show();

          // Show recipe that is clicked
          $.ajax({
            url: "Includes/Classes.php",
            type: "POST",
            data: {"callShowSingle": ID},
            success: function(response){
              $("#single").append(response);
            }
          });

          $("#fav").on("click", function(){
            // Add recipe to favourites
            $.ajax({
              url: "Includes/Classes.php",
              type: "POST",
              data: {"callAddFav": ID},
              success: function(response){
                if (response == "Added to Favourites") {
                  alert(response);
                }
                else {
                  alert("There was an error favouriting this recipe, please try again later.")
                  console.log(response);
                }
              }
            });
          });
        });
      }
    });
  }
});
