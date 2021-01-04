<?php 
	include_once "../init.php";
	if ($getFromU->loggedIn() === false) {
        header('Location: ../index.php');
    }
	include_once 'skeleton.php'; 	
?>

<div class="wrapper">
        <div class="row">
           <div class="col-12">
               <div class="card">
                   <div class="card-header">
                        <h4 style="font-family:'Source Sans Pro'; font-size: 1.3em; text-align: center">Expenses incurred between <?php echo date('F, Y', strtotime($_POST['mthfrom'])); ?> and <?php echo date('F, Y', strtotime($_POST['mthto'])); ?></h4>    
                   </div>
                   <div class="card-content">
                   <table>
							<thead>
								<tr>
									<th>Serial No.</th>
									<th>Item</th>
									<th>Cost</th>
									<th>Month</th>
								</tr>
							</thead>
							<tbody id="chart-facilitate1">
								<?php 
									$_POST['mthto'] = $_POST['mthto']."-01";
									$_POST['mthfrom'] = $_POST['mthfrom']."-01";

									$mthexp = $getFromE->mthwise($_SESSION['UserId'],$_POST['mthfrom'],$_POST['mthto']);
									if($mthexp !== NULL)
									{
										$len = count($mthexp);
										for ($x = 1; $x <= $len; $x++) {
										echo "<tr>
											<td>".$x."</td>
											<td>".$mthexp[$x-1]->Item."</td>
											<td>"."₹ ".$mthexp[$x-1]->Cost."</td>
											<td>".date("d-m-Y",strtotime($mthexp[$x-1]->Date))."</td>
										</tr>";	
									  }
									}
								?>
                                
							</tbody>
						</table>
                   </div>
               </div>
           </div>
		   <div class="col-12 col-m-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            Expense Graph
                        </h3>
						<div class="card-content">
							<canvas id="myChart1" ></canvas>
						</div>
                    </div>
                </div>
            </div>
        </div>
</div>
<script src="../static/js/8-Monthly-Detailed.js"></script>

