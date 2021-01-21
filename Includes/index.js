$(document).ready(function(){
  /*** Navigation Bar Animations and Functions ***/
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

  /*** Login and Account Changing ***/
  console.log(username);
  if(username != '') {
    $(".login").text("Account");
    $(".login").attr("href", "account.php");
  }
  if(username == '') {
    $("#login").text("Login");
    $("#login").attr("href", "login.php");
  }

  /*** Verification using AJAX ***/
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
