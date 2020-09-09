<?php 
	include_once "init.php";
	if ($getFromU->loggedIn() === false) {
        header('Location: 1-login.php');
    }
	include_once 'skeleton.php'; 

	if(isset($_POST['addexpense']))
	{
		$dt = date("Y-m-d H:i:s", strtotime($_POST["dateexpense"]));
		$itemname = $_POST['item'];
		$itemcost = $_POST['costitem'];
		$getFromE->create("expense", array('UserId'=>$_SESSION['UserId'], 'Item' => $itemname, 'Cost'=>$itemcost, 'Date' => $dt));
		echo "<script>alert('Records Updated Successfully');</script>";
	}


?>

<div class="wrapper">
        <div class="row">
            <div class="col-12 col-m-12 col-sm-12" >
                <div class="card">
                <!-- style="height: 40vh; display: flex; align-items: center; justify-content: center;" -->
                    <div class="counter bg-danger" style="height: 60vh; display: flex; align-items: center; justify-content: center;">
                    <form action="" method="post">
								<div>
									<label style="font-family: 'Source Sans Pro'; font-size: 1.3em; ">Date of Expense:</label><br><br>
									<input class="text-input" type="datetime-local" value="" name="dateexpense" required="true" style="width: 100%; padding-top: 8px; "><br><br>
								</div>
								<div>
									<label style="font-family: 'Source Sans Pro'; font-size: 1.3em; ">Item:</label><br>
									<input type="text" class="text-input" name="item" value="" required="true" style="width: 100%; padding-top: 10px; "><br><br>
								</div>
								
								<div>
									<label style="font-family: 'Source Sans Pro'; font-size: 1.3em; ">Cost of Item:</label><br>
									<input class="text-input" type="text" value="" required="true" name="costitem" onkeypress='validate(event)' style="width: 100%; padding-top: 10px; "><br><br>
								</div>
																
								<div><br>
									<button type="submit" class="pressbutton" name="addexpense">Add</button>
								</div>								
								
								</div>
								
							</form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <script src="5-Add-Expenses.js"></script>