<?php
  // start the session
  session_start();
    $connection = mysqli_connect("remotemysql.com:3306","fsuWU0m3JX","FPvwWXbQvU","fsuWU0m3JX");

  if (isset($_POST['login'])) {
    # code...
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

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
      $username = $row['username'];
      // save username and id to the session
      $_SESSION['id'] = $id;
      $_SESSION['username'] = $username;
    }else {
      echo "<br> Wrong Credentials. Please Create an account";
      exit();
    }
}

if (isset($_POST['signup'])) {

    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $password2 = mysqli_real_escape_string($connection, $_POST['password2']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    
    $vars = array('password','password2', 'username', 'email');
    $verified = TRUE;
    foreach($vars as $v) {
       if(!isset($_POST[$v]) || empty($_POST[$v])) {
          $verified = FALSE;
       }
    }
    if(!$verified) {
      echo "Ensure all fields are filled";
      exit();
    }
    
    if ($password != $password2) {
      echo "Passwords do not match!";
      exit();
    }
    
    $sql = "INSERT into user (username, email, password) values ('$username', '$email', '$password')";
    
    $run_sql = mysqli_query($connection, $sql);
    if ($run_sql) {
      echo "Sign Up Successful";
    }
}
?>
