<html>
  <head>
     <title>Connecting MySQL Server</title>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
 <form method="POST">
    <input type="username" name="username" placeholder="enter your username"><br><br>
    <input type="password" name="password" placeholder="enter your password"><br><br>
    <input type="submit" name="submit">

  </form><br>
    
  </body>
</html>

<?php 
  
  
  if (empty($_POST)) {
    # code...
  }

  else {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $connection = mysqli_connect("localhost","root","","test");

    $sql = "SELECT * FROM tbl_users WHERE username = '$username' AND password = '$password'";

    //above query confirms if user inputs are the ones in db

    $response = mysqli_query($connection, $sql);

    // response has 0 row or i row

    $num_rows = mysqli_num_rows($response);

    if ($num_rows < 1) {
      echo "<br> Wrong credentials, Please create account";
      exit();
    }

    elseif ($num_rows > 1) { //theres a double registration

      echo "Error, Contact admin";
      exit();

    }

    elseif ($num_rows==1) 
    {//Right credentials redirect...to insertCar.php
      //create a session
      //what is the role of logged in person
      $row = mysqli_fetch_array($response);
      $username = $row[3];
      $role = $row[4];

      session_start();
      $_SESSION['username'] = $username;
      $_SESSION['role'] = $role;

      //we store user logged in user details in sessions(temporary)
      

      header("echo("Hello")");

/*      echo "$role  $username $user_id";
*/    }

    else{
      echo "<br> Wrong Credentials. Please Create an account";
      exit();
    }







  }


 ?>