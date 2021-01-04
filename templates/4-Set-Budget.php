<?php 
    include_once "../init.php";
    if ($getFromU->loggedIn() === false) {
        header('Location: ../index.php');
    }
    include_once 'skeleton.php'; 


    if(isset($_POST['enterbudget']))
    {
        echo '<script>
        Swal.fire({
            title: "Done!",
            text: "Records Updated Successfully",
            icon: "success",
            confirmButtonText: "Cool"
          })
        </script>';

        $user_id = $_SESSION['UserId'];
        $budget = $_POST['budget'];
        
        $curr_budget = $getFromB->checkbudget($user_id);

        if($curr_budget == NULL)
        {
            $getFromB->setbudget($user_id,$budget);
        }
        else
        {
            $getFromB->updatebudget($user_id, $budget);
        }
        
    }
?>

<div class="wrapper">
        <div class="row">
            <div class="col-12 col-m-12 col-sm-12" >
                <div class="card">
                    <div class="counter bg-danger"  style="height: 40vh; display: flex; align-items: center; justify-content: center;">
                        <form action="" method="post"> 
                                <p style="font-size: 1.4em; color:White; font-family:'Source Sans Pro'">
                                    Enter your budget for this month:
                                </p><br>
                                <input type='text' name="budget" onkeypress='validate(event)' class="text-input" style="color:black;font-size: 1.2em;;background: rgba(0,0,0,0);text-align: center; border: none; outline: none; border-bottom: 2px solid black;" required/><br><br><br>
                                <button type="submit" name="enterbudget" class="pressbutton">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <script src="../static/js/4-Set-Budget.js"></script>

