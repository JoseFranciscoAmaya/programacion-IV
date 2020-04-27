<?php

  $connect = mysqli_connect('localhost','root','','db_mayores');
  session_start();

  if(isset($_SESSION["username"]))
 {
      header("location:entry.php");
 }
 if(isset($_POST["register"]))
 {
      if(empty($_POST["username"]) && empty($_POST["password"]))
      {
           echo '<script>alert("Campo Requerido")</script>';
      }
      else
      {
           $username = mysqli_real_escape_string($connect, $_POST["username"]);
           $password = mysqli_real_escape_string($connect, $_POST["password"]);
           $password = md5($password);
           $query = "INSERT INTO users (username, password) VALUES('$username', '$password')";
           if(mysqli_query($connect, $query))
           {
                echo '<script>alert("Usuario Registrado Correctamente")</script>';
           }
      }
 }
 if(isset($_POST["login"]))
 {
      if(empty($_POST["username"]) && empty($_POST["password"]))
      {
           echo '<script>alert("Campo Requerido")</script>';
      }
      else
      {
           $username = mysqli_real_escape_string($connect, $_POST["username"]);
           $password = mysqli_real_escape_string($connect, $_POST["password"]);
           $password = md5($password);
           $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
           $result = mysqli_query($connect, $query);
           if(mysqli_num_rows($result) > 0)
           {
                $_SESSION['username'] = $username;
                header("location:inicio.php");
           }
           else
           {
                echo '<script>alert("Datos de Usuario Incorrectos")</script>';
           }
      }
 }
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BIENVENIDO</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
    	.login-form {
    		width: 340px;
        	margin: 50px auto;
    	}
        .login-form form {
        	margin-bottom: 15px;
            background: #f7f7f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }
        .login-form h2 {
            margin: 0 0 15px;
        }
        .form-control, .btn {
            min-height: 38px;
            border-radius: 2px;
        }
        .btn {
            font-size: 15px;
            font-weight: bold;
        }
    </style>

  </head>
  <body>
  <?php
  if(isset($_GET["action"]) == "login")
  {
  ?>
    <div class="login-form">
    <form method="post">
        <h2 class="text-center">Log in</h2>
        <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="Usuario" required="required">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Contraseña" required="required">
        </div>
        <div class="form-group">
            <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
        </div>
    </form>
    <p class="text-center"><a href="index.php">Registrar</a></p>
    </div>

                    <?php
                    }
                    else
                    {
                    ?>
                  <div class="login-form">
                    <form method="post">
                    <h2 class="text-center">Registrar</h2>
                      <div class="form-group">
                          <input type="email" name="username" class="form-control" placeholder="Email" required="required">
                      </div>
                      <div class="form-group">
                          <input type="password" name="password" class="form-control" placeholder="Contraseña" required="required">
                      </div>
                      <div class="form-group">
                          <button type="submit" name="register" value="Register" class="btn btn-primary btn-block">Registro</button>
                      </div>
                    </form>
                    <p class="text-center"><a href="index.php?action=login">Login</a></p>
                  </div>
                    <?php
                    }
                    ?>
               </div>
          </body>
     </html>
