<?php include('server.php') ?>
<?php include('errors.php'); ?>
<!doctype html>
<html lang="en" class="h-100">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Metro 4 -->
    <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-all.min.css">

    <title>Lexicom Messaging</title>
    <link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
</head>
<body class="h-100">
    <div class="w-50 pl-5 pr-5 bg-lightYellow float-left" style="height:100%;">
        <h4 class="text-center pt-1">Welcome to</h4>
        <div class="img-container text-center">
            <img src="../Images/Lexicom.png" class="w-50 h-50" />
        </div>
        <div>Lexicom is a free, simple messaging service that lets you communicate quickly and efficiently with your friends, family, and colleagues. Sign up and start chatting with tens of other users today!</div>
    </div>
    <div class="w-50 h-100 p-5 bg-blue float-right">
        <div class="bg-light text-center pt-2 pl-5 pr-5 w-100 shadow-lg rounded">
            <div id="login">
                <div><h5>Log in to start messaging</h5></div>
                <!-- <form class="custom-validation pb-1" id="loginForm">-->
				<form method="post" action="server.php">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <div class="row">
                        <div class="cell text-right form-group">
                            <input type="checkbox">
                            Remember me
                        </div>
                        <div class="cell text-left pb-1">
                            <span style="cursor:pointer; color:deepskyblue;">Forgot password</span>
                        </div>
                    </div>
                    <button type="submit" class="button yellow" name="login">Log in</button>
                </form>
                <div class="pb-3">
                    <div class="row">
                        <div class="cell">
                            <span style="color:darkgrey;">First time?</span>
                            <span style="cursor:pointer; color:deepskyblue;" onclick="changeForm();">Create an account</span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="signup" style="display:none;">
                <div><h5>Create your Account</h5></div>
                <!-- <form class="custom-validation pb-1" id="signupForm" novalidate>-->
				<form method="post" action="server.php">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Full Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="birth" placeholder="Birthday" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email_setup" placeholder="Email Address" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="username_setup" placeholder="Username" required>
                    </div>
                    <div class="form-group pb-3">
                        <input type="password" class="form-control" name="password_setup" placeholder="Password" required>
                    </div>
                    <button type="submit" class="button yellow" name="register">Sign up</button>
                </form>
                <div class="container pb-3">
                    <div class="row">
                        <div class="cell">
                            <span style="color:darkgrey;">Existing user?</span>
                            <span style="cursor:pointer; color:deepskyblue;" onclick="changeForm();">Log in</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>

    function changeForm() {
        $('#login').toggle();
        $('#signup').toggle();
    };

    //notify user if form information is invalid
    /*
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            var loginForm = $("#loginForm");
            Array.prototype.filter.call(loginForm, function (form) {

                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
            var signupForm = $("#signupForm");
            Array.prototype.filter.call(signupForm, function (form) {

                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();*/

</script>
