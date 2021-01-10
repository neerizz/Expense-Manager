<?php 
    include_once "../init.php";
    include_once '../connection.php';
    
    // User login check
    if (isset($_SESSION['UserId'])) {
      header('Location: 3-Dashboard.php');
    }


    if(isset($_POST['register']))
    {
        // Storing image path in database
        if(empty($_FILES['inpFile']['name']))
        {
            $target = '../static/images/userlogo.png';
        }
        else
        {
            // Unique profile image name for each user
            $profileImageName = time() .'_'. $_FILES['inpFile']['name'];
            $target = '../static/profileImages/' . $profileImageName;
        }
        

        $fullname = $_POST['full_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $signupError = "";

        // Form validation
        $email = $getFromU->checkInput($email);
        $fullname = $getFromU->checkInput($fullname);
        $username = $getFromU->checkInput($username);
        $password = $getFromU->checkInput($password);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            $signupError = "Invalid email";
        } 
        elseif (strlen($fullname) > 30 || (strlen($fullname)) < 2) 
        {
            $signupError = "Name must be between 2-30 characters";
        } 
        elseif (strlen($username) > 30 || (strlen($username)) < 3) 
        {
            $signupError = "Username must be between 3-30 characters";
        } 
        elseif (strlen($password) < 6) 
        {
            $signupError = "Password too short";
        }
        elseif (strlen($password) >30) 
        {
            $signupError = "Password too long";
        }
        else 
        {
            if ($getFromU->checkEmail($email) === true) 
            {
                $signupError = "Email already registered";
            } 
        
            if ($getFromU->checkUsername($username) === true) 
            {
                $signupError = "Username already exists";
            }
            else 
            {
                move_uploaded_file($_FILES['inpFile']['tmp_name'], $target);
                $user_id = $getFromU->create('user', array('Email' => $email,'Password' => md5($password), 'Full_Name' => $fullname, 'Username' => $username, 'Photo' =>$target, 'RegDate' => date("Y-m-d H:i:s")));
                $_SESSION['UserId'] = $user_id; 
                $_SESSION['swal'] = "<script>
                    Swal.fire({
                        title: 'Yay!',
                        text: 'Congrats! You are now a registered user',
                        icon: 'success',
                        confirmButtonText: 'Cool!'
                    })
                    </script>";
                header('Location: 3-Dashboard.php');
            }
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../static/images/wallet.png" sizes="16x16" type="image/png">
    <link rel="stylesheet" href="../static/css/2-sign-up.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Expense Tracker</title>    
</head>
<body>

    <div class="container">
        
        <div class="mob-hidden">
            <h1>Create Your Account!</h1>
        </div>

        <div class="img-container">
            <h1>Create Your Account!</h1>
            <img src="../static/images/registration.jpg" alt="">    
        </div>

        <form action="2-sign-up.php" method="post" id="form" onsubmit = "return validate()" enctype="multipart/form-data">
            
            <!-- Image Upload -->
            <div class="image-preview" id="imagePreview">
                <img src="" alt="Image Preview" class="image-preview__image" id="profileDisplay">
                <span class="image-preview__default-text"><img src="../static/images/userlogo.png" alt=""></span>
            </div>
            <label for="imageUpload" class="user-pic-btn" style="cursor: pointer;">Add Photo</label>
            <input type="file" name="inpFile" id="imageUpload" accept="image/*" style="display: none">
            
            <!-- User details -->
            <div class="group">
                <div class="form-control">
                    <i class="fa fa-user u1" aria-hidden="true"></i>
                    <input class="fname" onkeypress="return (event.charCode > 64 && 
                        event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" type="text" name="full_name" id="fullname" minlength="2" maxlength="30" placeholder="Full Name" required>
                    <br>
                    <small></small>
                </div>

                <div class="form-control">
                    <i class="fa fa-envelope u2" aria-hidden="true"></i>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                    <br>
                    <small></small>
                </div>
                

                <div class="form-control">
                    <i class="fa fa-user-plus u3" aria-hidden="true"></i>
                    <input type="text" name="username" id="username" placeholder="Username" minlength="3" maxlength="30" required>
                    <br>
                    <small></small>
                    <span id="uname_response" style="font-family: 'Source Sans Pro'; font-size:0.8em ; color:red; font-weight:bold"></span>
                </div>
                
                <div class="form-control">
                    <i class="fa fa-key u4" aria-hidden="true"></i>
                    <input type="password" name="password" id="password" placeholder="Password" minlength="6" maxlength="30" autocomplete="on" required>
                    <br>
                    <small></small>
                </div>

                <div class="form-control">   
                    <i class="fa fa-key u4" aria-hidden="true"></i>
                    <input type="password" name="password_confirm" id="confirmpassword" minlength="6" maxlength="30" placeholder="Confirm Password" autocomplete="on" required>
                    <br>
                    <small></small>
                </div>
                
            </div>
            <button type="submit" value="Submit" name="register">Let's Go!</button>
            <br>
            <?php  
                if (isset($signupError)) {
                    $font = "Source Sans Pro";
                    echo '<div style="color: red;font-family:'.$font.';">'.$signupError.'</div>';
                }
	        ?>
        </form>

    </div>
    
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script>
        $(document).ready(function(){

            $("#username").keyup(function()
            {
                var username = $(this).val().trim();
                if(username != '')
                {
                    $("#username").css({'margin-bottom':'5px'});
                    $("#uname_response").css({'margin-bottom':'15px'});
                    $.ajax({
                        url: '../ajaxfile.php',
                        type: 'post',
                        data: {username: username},
                        success: function(response){

                            $('#uname_response').html(response);

                        }
                    });
                }
                else
                {
                    $("#uname_response").html("<br/>");
                }
            });

        });
    </script>
    <script src="../static/js/2-sign-up.js"></script>

</body>
</html>