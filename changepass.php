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
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updatepass'])) {
        $updatepass = $user->updatePassword($userid,$_POST);
    }
?>
<!-- body text -->
<div class="mt-5 mb-5 border">
    <div class="p-3 bg-light border-bottom">
        <h3>Changed Password <span class="float-end"><a href="profile.php" class="btn btn-success">Back</a></span></h3>
    </div>
    <div style="width:600px;" class="m-auto p-4">
    <?php
        if (isset($updatepass)) {
            echo $updatepass;
        }
    ?>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="old_pass" class="form-label">Old Password</label>
            <input type="password" class="form-control" id="old_pass" name="old_pass" >
        </div>
        <div class="mb-3">
            <label for="new_pass" class="form-label">New Password</label>
            <input type="password" class="form-control" id="new_pass" name="new_pass">
        </div>

        <div class="mb-3">
            <button type="submit" name="updatepass" class="btn btn-success">update</button>
        </div>
        </form>
    </div>
    
</div>
<!-- body text -->
<?php include 'inc/footer.php' ?>