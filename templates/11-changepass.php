<?php 
    include_once "../init.php";

    // User login check
    if ($getFromU->loggedIn() === false) {
        header('Location: ../index.php');
    }

    include_once 'skeleton.php'; 

    // Password validation and change
    if(isset($_POST['changepwd']))
    {

        $old_pass_hash = $getFromU->userData($_SESSION['UserId'])->Password;
        $confirmpass = md5($_POST['oldpass']);
        function function_alert($message) {   
            echo "<script>
            Swal.fire({
                title: '',
                text: '$message',
                icon: '',
                confirmButtonText: 'Okay!'
            })
            </script>";
        } 
        if($confirmpass === $old_pass_hash)
        {
            $getFromU->update('user',$_SESSION['UserId'], array('Password' => md5($_POST['newpass'])));
            function_alert("Password Updated Successfully");
        }
        else
        {
            function_alert("Could Not Change Password");
        }
    }

?>

<div class="wrapper">
        <div class="row">
            <div class="col-12 col-m-12 col-sm-12" >
                <div class="card">
                    <div class="counter bg-danger" style="height: 60vh; display: flex; align-items: center; justify-content: center;">
                    <form action="" method="post" onsubmit="return validate()" id="form">
								
								<div class="formcontrol">
									<label style="font-family: 'Source Sans Pro'; font-size: 1.3em; ">Current Password:</label><br>
									<input type="password" class="text-input" name="oldpass" id="oldpass" value="" required="true" style="padding-top: 10px; "><br>
                                    <small></small>
                                </div>
                                <div class="formcontrol">
									<label style="font-family: 'Source Sans Pro'; font-size: 1.3em; ">New Password:</label><br>
									<input type="password" class="text-input" name="newpass" id="newpass" value="" required="true" style="padding-top: 10px; "><br>
                                    <small></small>
                                </div>
                                <div class="formcontrol">
									<label style="font-family: 'Source Sans Pro'; font-size: 1.3em; ">Re-Type Password:</label><br>
									<input type="password" class="text-input" name="cnewpass" id="cpass" value="" required="true" style="padding-top: 10px; "><br>
                                    <small></small>
                                </div>
																
								<div><br>
									<button type="submit" class="pressbutton" name="changepwd">Change Password</button>
								</div>								
								
								</div>
								
							</form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <script src="../static/js/11-changepass.js"></script>
    <link rel="stylesheet" src="../static/css/11-changepass.css">