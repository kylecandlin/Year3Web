$(document).ready(function(){
  function closeNav(){
    $("#nav-menu").slideUp("slow");
    $("#cross").hide();
    $("#hamburger").show();
  }

  function openNav(){
    $("#nav-menu").slideDown("slow");
    $("#hamburger").hide();
    $("#cross").show();
  }

  $(window).scroll(function(){
      if ($(document).scrollTop() > 10) {
        $(".nav-bar").css("box-shadow", "0 0 4px 0 rgba(0, 0, 0, 0.25), 0 0 20px 0 rgba(0, 0, 0, 0.2)");
      }
      else {
        $(".nav-bar").css("box-shadow", "none");
      }
  });

  $(window).resize(function(){
    closeNav();
  });

  $("#hamburger").click(function(){
    openNav();
  });

  $("#cross").click(function(){
    closeNav();
  });

  $("#username").keyup(function(){
    var username = $(this).val();
    $.ajax({
      type:"POST",
      url:"Includes/checkValues.php",
      data:({
        username: username
      }),
      datatype: "text",
      success: function(msg){
        if(msg == 1) {
          console.log("exists");
        }
        else if (msg == 0){
          console.log("not exists");
        }
      }
    });
  });
});
