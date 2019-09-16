<?php
  // start the session
  session_start();
    $connection = mysqli_connect("remotemysql.com:3306","fsuWU0m3JX","FPvwWXbQvU","fsuWU0m3JX");

  if (isset($_POST['login'])) {
    # code...
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";

    //above query confirms if user inputs are the ones in db

    $response = mysqli_query($connection, $sql);

    // response has 0 row or i row

    $num_rows = mysqli_num_rows($response);

    if ($num_rows < 1) {
      echo "<br> Wrong credentials, Please create account";
      exit();
    } elseif ($num_rows > 1) { //theres a double registration
      echo "Error, Contact admin";
      exit();
    } elseif ($num_rows==1) {
      //Right credentials redirect...to insertCar.php
      //create a session
      //what is the role of logged in person
      $row = mysqli_fetch_array($response);
      $email = $row['email'];
      // save email and id to the session
      $_SESSION['id'] = $id;
      $_SESSION['email'] = $email;
    }else {
      echo "<br> Wrong Credentials. Please Create an account";
      exit();
    }
}

if (isset($_POST['signup'])) {

    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    
    $vars = array($password, $email);
    $verified = TRUE;
    foreach($vars as $v) {
       if(!isset($v) || empty($v)) {
          $verified = FALSE;
       }
    }
    if(!$verified) {
      echo "Ensure all fields are filled";
      exit();
    }
    
    $check = mysqli_num_rows(mysqli_query($connection, "SELECT * from user where email = '$email'"));

    if ($check > 0) {
      echo "That email is being used by another user";
      exit();
    }

    $sql = "INSERT into user (email, password) values ($email', '$password')";
    
    $run_sql = mysqli_query($connection, $sql);
    if ($run_sql) {
      echo "Sign Up Successful";
    }
}
?>
