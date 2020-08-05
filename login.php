<?php
require_once "includes/service/appvars.php";
// CHECK IF THE SESSION IS THERE
if(!isset($_SESSION)) {
        session_start();
}
if(isset($_SESSION['ecrossing_client_email'])) {
    header('Location: '.SITE_BASE_URL.'client-panel/dashboard');
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Ecrossing Login</title>
    <meta name="robots" content="noindex,nofollow" />
    <link rel='stylesheet ' href="../css/jquery-ui.css">
    <link rel="stylesheet " type="text/css" href="css/font-awesome.min.css" />
    <link rel="stylesheet " type="text/css" href="css/bootstrap-3.3.7.min.css">
    <link rel="stylesheet " type="text/css" href="css/login.css"/>
    <!-- Scripts -->
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js" ></script>
    <script type="text/javascript" src="js/bootstrap-3.3.7.min.js" ></script>
    <!-- // <script type="text/javascript" src="js/custom.js"></script> -->
</head>
<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Roboto;
    font-size: 1.2em;
    background-size: 200% 100% !important;
    animation: move 10s ease infinite;
    transform: translate3d(0, 0, 0);
    background: linear-gradient(45deg, #49D49D 10%, #A2C7E5 90%);
    height: 100vh
}

.user {
    width: 90%;
    max-width: 340px;
    margin: 10vh auto;
}

.user__header {
    text-align: center;
    opacity: 0;
    transform: translate3d(0, 500px, 0);
    animation: arrive 500ms ease-in-out 0.7s forwards;
}

.user__title {
    font-size: 1.2em;
    margin-bottom: -10px;
    font-weight: 500;
    color: white;
}

.form {
    margin-top: 40px;
    border-radius: 6px;
    overflow: hidden;
    opacity: 0;
    transform: translate3d(0, 500px, 0);
    animation: arrive 500ms ease-in-out 0.9s forwards;
}

.form--no {
    animation: NO 1s ease-in-out;
    opacity: 1;
    transform: translate3d(0, 0, 0);
}

.form__input {
    display: block;
    width: 100%;
    padding: 20px;
    font-family: Roboto;
    -webkit-appearance: none;
    border: 0;
    outline: 0;
    transition: 0.3s;
    
    &:focus {
        background: darken(#fff, 3%);
    }
}

.client-login-btn {
    display: block;
    width: 100%;
    padding: 20px;
    font-family: Roboto;
    -webkit-appearance: none;
    outline: 0;
    border: 0;
    color: white;
    background: #ABA194;
    transition: 0.3s;
    font-weight: 600;
    &:hover {
        background: #a09486;
    }
}

.error {
    text-align: center;
    font-weight: bold;
    color: #FF0000;
}

@keyframes NO {
  from, to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }

  10%, 30%, 50%, 70%, 90% {
    -webkit-transform: translate3d(-10px, 0, 0);
    transform: translate3d(-10px, 0, 0);
  }

  20%, 40%, 60%, 80% {
    -webkit-transform: translate3d(10px, 0, 0);
    transform: translate3d(10px, 0, 0);
  }
}

@keyframes arrive {
    0% {
        opacity: 0;
        transform: translate3d(0, 50px, 0);
    }
    
    100% {
        opacity: 1;
        transform: translate3d(0, 0, 0);
    }
}

@keyframes move {
    0% {
        background-position: 0 0
    }

    50% {
        background-position: 100% 0
    }

    100% {
        background-position: 0 0
    }
}
</style>
<body>
<div class="main-container body">
	<div class="user">
    <header class="user__header">
        <!-- <img src="<?php echo SITE_BASE_URL; ?>images/logo.png" class="img-responsive" alt="Ecrossing Logo"> -->
        <h1 class="user__title">Login to Ecrossing Panel</h1>
    </header>
    
    <form class="client-login form">
        <p class="error red"></p>
        <div class="form__group">
            <input type="email" id="email" placeholder="Email" class="form__input" />
        </div>
        
        <div class="form__group">
            <input type="password" id="password" placeholder="Password" class="form__input" />
        </div>
        
        <button class="client-login-btn" type="button" onclick="client_login();">Login to Dashboard</button>
    </form>
  </div>
</div>
<body>
<script type="text/javascript">
$(".client-login").keyup(function(event){
    if(event.keyCode == 13){
        $(".client-login-btn").click();
    }
});
function client_login() {
  var email = $('#email').val();
  var pass = $('#password').val();
  if(email!="" && pass!="") {
  	$.ajax({
            type:'POST',
            url:'includes/utility/handleLogin.php',
            dataType : "json",
            data:{
              handle_client_login : 1,
              email : email,
              password : pass
            },
            error: function (xhr, ajaxOptions, thrownError) {
              //alert(xhr.status);
              alert(thrownError);
              console.log(xhr);
              console.log(ajaxOptions);
              console.log(thrownError);
            },
            beforeSend: function(){
                //alert("Sending Data..");
            },
            success: function(data) {
            	if(data.error) {
            		$('.error').text(data.error);
            	} else {
            		window.location.href="client-panel/dashboard";
            	}
          }
    });
  } else {
  	if(email=="") {
  		$('.error').text("Enter your Email!");
  	} else {
  		$('.error').text("Password cannot be Empty!");
  	}
  }
}
</script>
</html>