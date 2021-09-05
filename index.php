<?php 
    include 'inc/header.php';
    include 'lib/User.php' ;
    Session::checkSession();
    $user = new User();
?>
<?php
    $loginmsg = Session::get("loginmsg");
    if (isset($loginmsg)) {
        echo $loginmsg;
    }
    Session::set("loginmsg", NULL);
?>
        <!-- body text -->
        <div class="mt-5 mb-5 p-4 border">
            <div class="bg-light p-3">
                <h2>UserList <span class="float-end">Welcome!<strong>
                 <?php 
                    $name = Session::get("username");
                    if(isset($name)){
                        echo $name;
                    }
                    
                 ?>
                 </strong>
                 </span></h2>
            </div>
            <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">Serial</th>
                <th scope="col">Name</th>
                <th scope="col">Username</th>
                <th scope="col">Email Address</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>


<?php
    $user = new User();
    $userdata = $user->getUserData();
    if ($userdata) {
        $i=0;
        foreach ($userdata as $sdata) {
            $i++;
?>

                <tr>
                <th scope="row"><?php echo $i; ?></th>
                <td><?php echo $sdata['name'] ?></td>
                <td><?php echo $sdata['username'] ?></td>
                <td><?php echo $sdata['email'] ?></td>
                <td><a class="btn btn-success" href="profile.php?id=<?php echo $sdata['id'] ?>">View</a></td>
                </tr>

<?php
     }
    }else{?>
    <tr><td colspan="5"><h2>No User Data Found..</h2></td></tr>
    <?php } ?>

            </tbody>
            </table>
        </div>
        
        <!-- body text -->

<?php include 'inc/footer.php' ?>