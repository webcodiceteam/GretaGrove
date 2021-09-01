<?php

include('header.php');
    $message="";
    if(count($_POST)>0) { 

$result = mysqli_query($conn,"SELECT * FROM jitendra_login WHERE email='".$_POST["email"] . "' and password = '". $_POST["password"]."' "); 
// print_r("SELECT * FROM jitendra_login WHERE email='".$_POST["email"] . "' and password = '". $_POST["password"]."' ");
$row = mysqli_fetch_array($result); 
if(is_array($row))
 {
    $_SESSION["id"] = $row['id'];
    $_SESSION["email"] = $row['email'];
    $_SESSION['password'] = $row['password'];
   $role = $row['role'];
    if($role =='admin' )
    {
        $_SESSION['admin'] = true;

        header("Location:Admin.php");
    }
    else
    {
        $_SESSION['admin'] = false;
        header("Location:welcome.php");
    }
    

} 
else { $message = "Invalid Username or Password!"; 
} 

}

?>
    <main>
        <div class="container-fluid" class="my_main_con">
            <div class="row">
                <div class="col-sm-5  login-section-wrapper" style="width:478px;">
                    <div class="brand-wrapper"></div>
                    <div class="login-wrapper my-auto">
                        <h1 class="login-title">Log in</h1>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="email@example.com" />
                            </div>
                            <div class="form-group mb-4">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="enter your passsword" />
                            </div>
                            <input name="login" id="login" class="btn btn-block login-btn" type="submit"
                                value="Login" />
                        </form>
                        <!-- <p class="login-wrapper-footer-text">
                            Don't have an account?
                            <a href="signup.php" class="text-reset">Register here</a>
                        </p> -->
                    </div>
                </div>
                <div class="col-sm-7 px-0 d-none d-sm-block">
                    <img src="assets/images/image.jpg" alt="login image" style="height:80vh;width:100%" />
                </div>
            </div>
            </div>
            <?php
                include 'footer.php';
            ?>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>