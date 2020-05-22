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

  $(".clickable").click(function(){
    $("#list").hide();
    $("#single").show();
  //   var ID = $(this).attr("ID");
  //
  //   $.ajax({
  //     url: "Includes/Classes.php",
  //     type: "POST",
  //     data: {"callShowSingle": ID},
  //     success: function(response){
  //       $("#single").append(response);
  //     }
  //   })
  });

  // Function that displays recipe list using AJAX call
  function showAll(orderBy){
    $(".clickable").remove();

    // AJAX call to show all recipes ordered by the sropdown list
    $.ajax({
      url: "Includes/Classes.php",
      type: "POST",
      data: {"callShowAll": orderBy},
      success: function(response){
        $("#list").append(response);
      }
    });
  }
});
