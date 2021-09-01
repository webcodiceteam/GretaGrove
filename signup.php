<?php

?>

<?php 

include 'config.php';

if(isset($_POST["signupbtn"]))

{

 $stu_name = $_POST['username'];

 $stu_email = $_POST['email'];

 $stu_role = 'user';

 $stu_password = $_POST['password'];

 $sql = " INSERT INTO jitendra_login (username,email,password,role) VALUES ('{$stu_name}', '{$stu_email}', '{$stu_password}','{$stu_role}')";

 $result = mysqli_query($conn, $sql) or die("query unsuccessfull.");

//  header("Location:http://localhost/Newwork/login/index.php");

 mysqli_close($conn);

}

include('header.php');

?>
    <main>

        <div class="container-fluid" class="my_main_con">

            <div class="row">

                <div class="col-sm-5 login-section-wrapper">

                    <div class="brand-wrapper">

                    </div>

                    <div class="login-wrapper my-auto">

                        <h1 class="login-title">Signup </h1>

                        <form action="#" method="post">

                            <div class="form-group">

                                <label for="username">UserName</label>

                                <input type="text" name="username" id="username" class="form-control"

                                    placeholder="Enter Your Name" />

                            </div>

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

                            <input name="signupbtn" id="signupbtn" class="btn btn-block login-btn" type="submit"

                                value="Signup" />

                        </form>

                        <p class="login-wrapper-footer-text">

                            You have an account?

                            <a href="index.php" class="text-reset">Login here</a>

                        </p>

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