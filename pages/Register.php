<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> register</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    .width {
        width: 600px;
    }

    @media(max-width: 600px) {
        .width {
            width: 350px;
        }
    }

    .error {
        color: red;
        font-size: large;

    }

    .success {
        color: green;
        font-size: large;

    }

    .error1 {
        color: red;
        font-size: large;

    }

    .success1 {
        color: green;
        font-size: large;

    }

    #message1 {
        color: red;
    }

    #message2 {
        color: red;
    }

    #message3 {
        color: red;
    }

    #message4 {
        color: red;
    }

    #message5 {
        color: red;
    }

    img {
        margin: auto;
        border-radius: 3px;
        border: 1px solid grey;
        height: 190px;
        width: 180px;
    }
    </style>
</head>

<body>
    <div class="container-fluid pt-2 pb-5 bg-light">
        <div class="container border width rounded border-success">
            <h1 class="pt-1 text-center pb-2">Register form</h1>
            <hr class="border-bottom bg-success w-50 mx-auto">
            <p class="pt-2 pb-3 text-center">
                Already registered?
                <a href="sign-in.php" class="btn btn-primary">Login</a>
            </p>
            <hr class="border-bottom bg-success w-50 mx-auto">

            <form class="pt-3 w-50 mx-auto pb-3">
                <label class="pb-2 text-center"> Name </label><span id="message1">*</span>
                <input type="text" class="form-control" placeholder="Enter your first name" id="name" required>

                <label class="pt-1 pb-2 text-center">Specialization </label><span id="message2">*</span>
                <input type="text" class="form-control" placeholder="Enter your Specialization" id="Specialization"
                    required>


                <label class="pt-1 text-center">Email</label><span id="message3">*</span>
                <input type="email" class="form-control" placeholder="Enter your email" id="email" required>


                <label class="pt-1 pb-2 text-center">Mobile/Phone </label><span id="message4"> *</span>
                <input type="number" class="form-control" placeholder="Enter your 10 digit mobile number" id="mobile"
                    required>

                <label class="pt-1 pb-2 text-center">age </label><span id="message9"> *</span>
                <input type="number" class="form-control" placeholder="Enter your age " id="age" required>

                <label class="pt-1 pb-2 text-center">Address</label><span class="text-danger">*</span>
                <textarea class="form-control" value="bnj" placeholder="Enter your complete address" id="address"
                    required></textarea>

                <label class="pt-1 pb-2 text-center">Enter Password</label><span class="text-danger">*</span>
                <input type="password" class="form-control" placeholder="Enter password" id="password1" required>

                <label class="pt-1 pb-2 text-center">Repeat Password</label><span class="text-danger">*</span>
                <input type="password" class="form-control" placeholder="Repeat password" id="password2" required>
                <span id="message5"> </span>

                <div class="row align-items-center py-3">


                    <input class="form-control form-control-lg" id="formFileLg" type="file" />
                    <div class="small text-muted mt-2">Upload your Medical ID or any other relevant file. Max file
                        size 50 MB</div>

                </div>

                <br><br>
                <button type="button" class="form-control btn btn-outline-primary" id="submit" disabled="true"
                    onclick="getValues()">Submit</button>
                <br><br>
                <span class="error"></span><span class="success"></span>

            </form>




        </div>
    </div>


    <script src="script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    $('#password1, #password2').on('keyup', function() {
        if ($('#password1').val() == $('#password2').val() && $('#password1').val().length != 0) {
            $('#message5').html('Matched').css('color', 'green');
            $("#submit").prop('disabled', false);
        } else {
            $('#message5').html('Password Missmatch').css('color', 'red');
            $("#submit").prop('disabled', true);
        }
    });

    $('#name').on('keyup', function() {
        if ($('#name').val().length != 0) {
            $('#message1').html('*').css('color', 'green');
            $("#submit").prop('disabled', false);

        } else {
            $('#message1').html('*').css('color', 'red');
            $("#submit").prop('disabled', true);
        }
    });
    $('#Specialization').on('keyup', function() {
        if ($('#Specialization').val().length != 0) {
            $('#message2').html('*').css('color', 'green');
            $("#submit").prop('disabled', false);

        } else {
            $('#message2').html('*').css('color', 'red');
            $("#submit").prop('disabled', true);
        }
    });
    var validateEmail = function(elementValue) {
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        return emailPattern.test(elementValue);
    }



    $('#email').keyup(function() {

        var value = $(this).val();
        var valid = validateEmail(value);

        if (!valid) {


            $('#message3').html(' Invalid email').css('color', 'red');
            $("#submit").prop('disabled', true);

        } else {


            $('#message3').html(' *').css('color', 'green');
            $("#submit").prop('disabled', false);

        }
    });


    $('#mobile').on('keyup', function() {
        if ($('#mobile').val().length == 10) {
            $('#message4').html(' *').css('color', 'green');

        } else
            $('#message4').html(' Enter 10 digits').css('color', 'red');

    });
    $('#age').on('keyup', function() {
        if ($('#age').val().length == 2) {
            $('#message9').html(' *').css('color', 'green');

        } else
            $('#message9').html(' Enter 2 digits').css('color', 'red');

    });
    </script>
</body>

</html>