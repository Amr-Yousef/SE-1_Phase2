function getValues() {
    var firstName    = $('#name').val();
    var lastName     = $('#Specialization').val();
    var email        = $('#email').val();
    var mobile       = $("#mobile").val();
    var ssn          = $("#SSN").val();
    var monthlyIncome = $('#age').val();
    var country      = $('#country').val();
    var city         = $("#city").val();
    var password     = $('#password1').val();

    if (
      firstName.length !== 0 &&
      lastName.length !== 0 &&
      email.length !== 0 &&
      mobile.length == 10 &&
      ssn.length == 14 &&
      monthlyIncome.length !== 0 &&
      country.length !== 0 &&
      city.length !== 0 
    ) {
      var input = {
        firstName: firstName,
        lastName: lastName,
        email: email,
        phoneNo: mobile,
        SSN: ssn,
        country: country,
        city: city,
        monthlyIncome: monthlyIncome,
        password: password,
        action: "save_into_db",
      };
      $.ajax({
        url: "controller.php",
        type: "POST",
        dataType: "json",
        data: input,
        success: function (response) {
          $(".success").html(response.message).show();
          $(".error").hide();
        },
        error: function (response) {
          $(".error").html("Error").show();
          $(".success").hide();
        },
      });
    }

}