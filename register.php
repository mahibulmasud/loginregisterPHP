<?php 
    include 'inc/header.php';
    include 'lib/User.php';
    // Session::checkregistration();

    $user = new User();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
        $userRegi = $user->userRegistration($_POST);
    }
?>
<!-- body text -->
<div class="mt-5 mb-5 border">
    <div class="p-3 bg-light border-bottom">
        <h3>User Registration</h3>
    </div>
    <div style="width:600px;" class="m-auto p-4">
    
    <?php
        if(isset($userRegi)){
            echo $userRegi;
        }
    ?>
    
    
    <form action="" method="POST">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Name</label>
            <input type="text" class="form-control" id="email" name="name" placeholder="Your name" >
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">User Name</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Your username">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="name@example.com">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
        </div>
        <div class="mb-3">
            <button type="submit" name="register" class="btn btn-success">Submit</button>
        </div>
        </form>
    </div>
    
</div>
<!-- body text -->
<?php include 'inc/footer.php' ?>