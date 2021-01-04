<?php 
    include_once "../init.php";

    // User login check
    if ($getFromU->loggedIn() === false) {
        header('Location: ../index.php');
    }

    include_once 'skeleton.php'; 	

    // Gathering all user data
    $userobj = $getFromU->userData($_SESSION['UserId']);
    $fullname = $userobj->Full_Name;
    $usr_name = $userobj->Username;
    $emailid = $userobj->Email;
    $JoinDate = $userobj->RegDate;
    $picture = $userobj->Photo;
    

?>      

<div class="wrapper">
    <div class="row">
        <div class="col-12 col-m-12 col-sm-12" >
            <div class="card">
                <div class="counter bg-danger" style="display: flex; align-items: center; justify-content: center;">
                
                <form action="">
                    <h1 style="font-family: 'Source Sans Pro'">Profile</h1>

                    <div>
                        <img style="width:100px; height:100px; object-fit: cover; border-radius: 50%;" src=<?php echo '"'.$picture.'"' ?> alt="">
                    </div>
                    <div>
                        <p>Full Name:</p>
                        <input type="text" class="text-input"  style="width: 100%;" value=<?php echo '"'.$fullname.'"' ?>  readonly><br>
                    </div>
                    <div>
                        <p>User Name:</p>
                        <input type="text" class="text-input"  style="width: 100%;" value=<?php echo '"'.$usr_name.'"' ?> readonly><br>
                    </div>

                    <div>
                        <p>Email Id:</p>
                        <input type="email " style="width: 100%;" class="text-input" value=<?php echo '"'.$emailid.'"' ?> readonly><br>
                    </div>

                    <div>
                        <p>Registration Date:</p>
                        <input type="datetime" class="text-input" style="width: 100%; font-size: 1.1em; padding-left: 45px;" value=<?php echo '"'.$JoinDate.'"' ?> readonly><br>
                    </div>
                    <br>
                                                    
                    <div><br>
                        <a href="11-changepass.php"><button type="button" class="pressbutton" name="submit">Change Password</button></a>
                    </div>								
                    
                </form>
                </div>
            </div>
        </div>       
    </div>
</div>

    <script src="../static/js/10-Profile.js"></script>