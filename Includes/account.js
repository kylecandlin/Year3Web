$(document).ready(function(){
  // Show favourite recipes
  showFav();

  // Get Favourites from DB, append to section
  function showFav(){
    $.ajax({
      url: "Includes/Classes.php",
      type: "POST",
      data: {"callGetFav": username},
      success: function(response){
        $("#html-recipe-tbl").append(response);

        // Click handler for delete favourite button
        $(".del-img").on("click", function(){
          console.log("clicked");

          // Gets RecipeID from button ID
          var ID = $(this).attr("ID");

          // Delete recipe from favourites
          $.ajax({
            url: "Includes/Classes.php",
            type: "POST",
            data: {"callDelFav": ID},
            success: function(response){
              console.log(response);
              $("#recipe-tbl").remove();
              showFav();
            }
          });
        });
      }
    });
  }
});
