$("document").ready(function(){
  // Elements to display messages
  lenMsg = $("<p/>").addClass("error-report");
  charMsg = $("<p/>").addClass("error-report");
  numMsg = $("<p/>").addClass("error-report");

  // Append elements to error element
  $("#error").append(lenMsg, charMsg, numMsg);

  // Checks variable lengths
  function LenChk(word){
    if(word.length < 8) {
      $(lenMsg).text("Must be at least 8 characters long.");
    }
    else if(word.length = 0) {
      $(lenMsg).text("Please enter a username.");
    }
    else {
      $(lenMsg).text("");
    }
  }

  // Checks variable for capital letters
  function CharChk(word){
    if(word.replace(/[^A-Z]/g, "").length < 1) {
      $(charMsg).text("Must include a capital letter.");
    }
    else {
      $(charMsg).text("");
    }
  }

  // Checks variable for numbers
  function NumChk(word){
    if(word.replace(/[^0-9]/g, "").length < 1) {
      $(numMsg).text("Must include a number.");
    }
    else {
      $(numMsg).text("");
    }
  }

  // Checks variable meets requirements
  function pswdChk(word){
    LenChk(word);
    CharChk(word);
    NumChk(word);
  }

  // AJAX call to check password
  $("#password").keyup(function(){
    var password = $(this).val();

    $.ajax({
      type:"POST",
      data:({
        username: password
      }),
      datatype: "text",
      success: function(){
        pswdChk(password);
      }
    });
  });
});
