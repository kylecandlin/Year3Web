$("document").ready(function(){
  function passwordLenCheck(password){
    if (password.length < 8) {
      document.getElementById('passwordError').innerHTML = "Must be at least 8 characters long.";
    }
    else if (password.length = 0) {
      document.getElementById('passwordError').innerHTML = "Please enter a username.";
    }
    else {
      document.getElementById('passwordError').innerHTML = "";
    }
  }

  // Use jQuery for these ^

  function passwordCharCheck(password){
    if (password.replace(/[^A-Z]/g, "").length < 1) {
      document.getElementById('passwordError').innerHTML = "Must include a capital letter.";
    }
    else {
      document.getElementById('passwordError').innerHTML = "";
    }
  }

  $("#password").keyup(function(){
    var password = $(this).val();

    $.ajax({
      type:"POST",
      data:({
        username: password
      }),
      datatype: "text",
      success: function(){
        passwordLenCheck(password);
        passwordCharCheck(password);
      }
    });
  });
});
