<?php
session_start();
ob_start();
 ?>
<html>
<head>
  <script src="script.js"></script>
  <meta charset = "utf-8">
  <title>Log In</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <header>
    <h1>Login Page</h1>
  </header>
       <h2>Enter Username and Password</h2>
       <div class = "container form-signin">

          <?php
          include_once 'database_HW6F17.php';
          // Create connections
          $conn = new mysqli($db_servername,$db_username,$db_password,$db_name,$db_port); if ( $conn->connect_error ) {
          $msg = '';
            if (mysqli_connect_errno())
              {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
              }
          } else {
                // setup your query
                //run sql queries to get lists of valid usernames and passwords
                $sql = "select acc_name, acc_login, acc_password from  tbl_accounts";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                   if (isset($_POST['login']) && !empty($_POST['username'])
                      && !empty($_POST['password'])) {
                      if ($_POST['username'] == $row['acc_login'] &&
                         sha1($_POST['password']) == $row['acc_password']) {
                         $_SESSION['valid'] = true;
                         $_SESSION['timeout'] = time();
                         $_SESSION['username'] = $row['acc_name'];

                         header('Refresh: 0; URL = calendar.php');
                      }else if($_POST['username'] == $row['acc_login']){ //wrong password
                         $msg = 'Wrong password';
                         break;
                      } else {
                        $msg = 'Unknown login';
                      }
                   }
              }
          }

          $conn->close();
          }
          ?>
       </div> <!-- /container -->

       <div class = "container">

          <form class = "form-signin" role = "form"
             action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);
             ?>" method = "post">
             <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
             <input type = "text" class = "form-control"
                name = "username"
                required autofocus></br>
             <input type = "password" class = "form-control"
                name = "password"  required>
             <button class = "btn btn-lg btn-primary btn-block" type = "submit"
                name = "login">Login</button>
          </form>

          Click here to <a href = "logout.php" tite = "Logout">Logout.</a>

       </div>
</body>
</html>
