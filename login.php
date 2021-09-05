<?php 
    include 'lib/User.php';
    include 'inc/header.php';
    Session::checkLogin();

    $user = new User();
    // if (isset($_GET['id'])){
    //     $userid = (int)$_GET['id'];
    // }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
        $userLogin = $user->userLogin($_POST);
    }
?>
<!-- body text -->
<div class="mt-5 mb-5 border">
    <div class="p-3 bg-light border-bottom">
        <h3>User login</h3>
    </div>
    <div style="width:600px;" class="m-auto p-4">

    <?php
        if(isset($userLogin)){
            echo $userLogin;
        }
    ?>

    <form action="" method="POST">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="name@example.com">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
        </div>
        <div class="mb-3">
            <button type="submit" name="login" class="btn btn-success">Login</button>
        </div>
        </form>
    </div>
    
</div>
<!-- body text -->
<?php include 'inc/footer.php' ?>