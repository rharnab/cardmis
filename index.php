<?php
    //session_start();
    // already login users
    if(isset($_SESSION['login_id'])){
        header("Location:dashboard.php");
    }
    
?>
<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Card | MIS Amin login</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">
        <div class="form-box" id="login-box">
        	<div style="text-align:center; margin:0 0 30px 0"><img src="img/LOGO.png" width="100" height="100"/></div>
            <div class="header">Sign In - CardMIS</div>
            
            <form id="loginForm" action="login-action.php" method="post">
                <!-- action="dashboard.php" -->
                <div class="body bg-gray">
                    <div class="form-group">
                        <?php
                            if(isset($_SESSION['s'])){
                                echo $_SESSION['s'];
                                unset($_SESSION['s']);
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <input type="text" id="loginId" name="loginId" class="form-control" placeholder="User ID" required="1">
                        <span id="user"></span>
                    </div>
                    <div class="form-group">
                        <input type="password" id="loginPassword" name="password" class="form-control" placeholder="Password" required="1">
                        <span id="pass"></span>
                    </div>          
                </div>
                <div class="footer">
                    <button type="submit" class="btn bg-olive btn-block">Sign me in</button>
                    <p><a href="#">I forgot my password</a></p>
                </div>
            </form>
        </div>

        <!-- jQuery 2.0.2 -->
       
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script> 

        <script>
            $(document).ready(function(){
                $('.alert').css('color','red').fadeOut(4000);
            });
        </script>     

    </body>
</html>