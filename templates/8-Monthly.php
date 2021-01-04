<?php  
    include_once "../init.php";
    if ($getFromU->loggedIn() === false) {
        header('Location: ../index.php');
    }

    if(isset($_POST['datewise']))
    {
        header("Location: 8-Monthly-Detailed.php");
    }
    include_once 'skeleton.php'; 	
?>

<div class="wrapper">
    <div class="row">
        <div class="col-12 col-m-12 col-sm-12" >
            <div class="card">
                <div class="counter bg-danger" style="display: flex; align-items: center; justify-content: center;">
                
                <form action="8-Monthly-Detailed.php" method="post" id="mthform" onsubmit = "return validate()">
                    <h1 style="display: block; font-family: 'Source Sans Pro'">Monthwise Expense Report</h1>
                        <div class = "mthcontrol">
                            <label style="font-family: 'Source Sans Pro'; font-size: 1.3em; ">From:</label><br>
                            <input class="text-input" type="month" id='mthfrom' value="" name="mthfrom" required="true" style="width: 100%; padding-top: 8px; "><br><br><br>
                            <small></small>
                        </div>
                        <div class = "mthcontrol">
                            <label style="font-family: 'Source Sans Pro'; font-size: 1.3em; ">To:</label><br>
                            <input class="text-input" type="month" id="mthto" value="" name="mthto" required="true" style="width: 100%; padding-top: 8px; "><br><br>
                            <small style="font-family: 'Source Sans Pro'; font-size:1.01em;"></small>        
                        </div>									
                        <div><br>
                        <button type="submit" class="pressbutton" name="mthsubmit">Submit</button>
                        </div>								                            
                </form>
                
                </div>
            </div>
        </div>
        
    </div>
</div>

<script src="../static/js/8-Monthly.js"></script>