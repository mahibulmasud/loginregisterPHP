<?php $filepath = realpath(dirname(__FILE__));
  // echo $filepath;
  include_once $filepath.'/../lib/Session.php';
  Session::init();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login register System PHP</title>
    <link rel="stylesheet" href="inc/bootstrap.min.css">
    <script src="inc/jquery.min.js"></script>
    <script src="inc/bootstrap.min.js"></script>
</head>
<?php
  if(isset($_GET['action']) && $_GET['action'] == "logout"){
          Session::destroy();
  }
?>
<body>
    <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-secondary rounded">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Login register System PHP</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

        <?php
            $id = Session::get("id");
            $userlogin = Session::get("login");
            if($userlogin == true){
        ?>

        <li class="nav-item">
          <a class="nav-link" href="profile.php?id=<?php echo $id; ?>">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?action=logout">Logout</a>
        </li>
        <?php }else{ ?>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Register</a>
        </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>