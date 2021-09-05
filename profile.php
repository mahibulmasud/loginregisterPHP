<?php 
    include 'lib/User.php' ;
    include 'inc/header.php';
    Session::checkSession();
?>
<?php
    if (isset($_GET['id'])){
        $userid = (int)$_GET['id'];
    }
    $user = new User();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
        $updateusr = $user->updateUserData($userid,$_POST);
    }
?>
<!-- body text -->
<div class="mt-5 mb-5 border">
    <div class="p-3 bg-light border-bottom">
        <h3>User Profile <span class="float-end"><a href="index.php" class="btn btn-success">Back</a></span></h3>
    </div>
    <div style="width:600px;" class="m-auto p-4">
    <?php
        if (isset($updateusr)) {
            echo $updateusr;
        }
    ?>
    <?php 
        $userdata = $user->getUserById($userid);
        if($userdata){
    ?>

    <form action="" method="POST">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $userdata->name ?>">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">User Name</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $userdata->username ?>">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $userdata->email ?>">
        </div>
        <!-- <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" value="12345">
        </div> -->
        <?php 
            $sesId = Session::get("id");
            if ($userid == $sesId) {
        ?>
        <div class="mb-3">
            <button type="submit" name="update" class="btn btn-success">update</button>
            <a class="btn btn-primary" href="changepass.php?id=<?php echo $userid; ?>">Change Password</a>
        </div>
        <?php  } ?>
        </form>
        <?php } ?>
    </div>
    
</div>
<!-- body text -->
<?php include 'inc/footer.php' ?>