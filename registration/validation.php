<!DOCTYPE html>
<html>
<head>
  <title>Data Processor</title>
</head>
<body>
    <?php
        include 'db.php';
        session_start();
        if (isset($_POST['reg_user'])) {
          $username = $_POST['username'];
          $email = $_POST['email'];
          $password = md5($_POST['password']);
          $password_1 = $_POST['password_1'];
          $date_registered = date('y-m-d h:i:s');

          if (empty($username)) { echo "username is required.";}
          if (empty($email)) { echo "email is required";}
          if (empty($password)) { echo "password is required.";}
            if ($password != $password_1) {
              echo "Both passwords do not match.";
            }
          
          $result = mysqli_query($db, "SELECT * FROM register WHERE username ='$username' OR email='$email'LIMIT 1");
          $user = mysqli_fetch_assoc($result);

          if ($user) {
            if ($user['username'] === $username ) {
              echo "username already exist.";
            }

            if ($user['email'] === $email) {
              echo "email already exist";
            }
          }
          else{
            $insert = mysqli_query($db, "INSERT INTO register (username,email,password,date_registered) VALUES ('$username','$email','$password','$date_registered')");

            $_SESSION['username'] = $username;
            $_SESSION['success'] = "you are now loggedin";
            header('location: dashboard.php');
          }
        }

    if (isset($_POST['login_user'])) {
      $username = $_POST['username'];
      $password = md5($_POST['password']);

      if (empty($username) || empty($password)) {
        echo "login username or password";
      }
      else {
        $loggedin = mysqli_query($db, "SELECT * FROM register WHERE username='$username' AND password='$password'");
        if (mysqli_num_rows($loggedin) > 0) {
          $_SESSION['username'] = $username;
          header('location: dashboard.php');
        }
        else {
          echo "incorrect username/password!";
        }
      }
    }
    ?>    
</body>
</html>