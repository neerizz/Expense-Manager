<?php 
    include_once "../init.php";

    // User login check
    if ($getFromU->loggedIn() === false) {
        header('Location: ../index.php');
    }

    // Date validation + form redirection
    if(isset($_POST['yrsubmit']))
    {
        if($_POST['yrfrom'] > $_POST['yrto'])
        {
            $error="Invalid Date Range";
        }
        else
        {
            $_SESSION['yrto'] = $_POST['yrto'];
            $_SESSION['yrfrom'] = $_POST['yrfrom'];

            header("Location: 9-Yearly-Detailed.php");
        }
    }

    include_once 'skeleton.php'; 	
?>

<script src="../static/js/9-Yearly.js"></script>

<div class="wrapper">
    <div class="row">
        <div class="col-12 col-m-12 col-sm-12" >
            <div class="card">
                <div class="counter bg-danger" style="display: flex; align-items: center; justify-content: center;">
                
                <form action="" method="post">
                    <h1 style="display: block; font-family: 'Source Sans Pro'">Yearwise Expense Report</h1>
                    <div>
                        <label style="font-family: 'Source Sans Pro'; font-size: 1.3em; ">From:</label><br>
                        <input class="text-input yearpicker"  type="text" id="yrfrom"  value="" name="yrfrom" required="true" style="width: 100%; padding-top: 8px; "><br><br><br>                                
                    </div>

                    <div>
                        <label style="font-family: 'Source Sans Pro'; font-size: 1.3em; ">To:</label><br>
                        <input class="text-input yearpicker" type="text" id="yrto" value="" name="yrto" required="true" style="width: 100%; padding-top: 8px; "><br><br>
                        <small style="font-family:'Source Sans Pro'; font-size: 1.01em;"><?php if(isset($error)){echo $error;} ?></small>
                    </div>
                                                    
                    <div class="form-group has-success"><br>
                        <button type="submit" class="pressbutton" name="yrsubmit">Submit</button>
                    </div>								
                    
                    </div>
                    
                </form>

                </div>
            </div>
        </div>
    </div>
</div>


