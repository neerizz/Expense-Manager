<?php 
	include_once 'init.php'; 
	if ($getFromU->loggedIn() === false) {
        header('Location: 1-login.php');
    }
	include_once 'skeleton.php';
?>

<div class="wrapper">
        <div class="row">
           <div class="col-12">
               <div class="card">
                   <div class="card-header">
                        
                        <!-- <i class="fas fa-ellipsis-h"></i> -->
                        <h4 style="font-family:'Source Sans Pro'; font-size: 1.3em; text-align: center">Expenses incurred between <?php echo date("d-m-Y",strtotime($_POST['dtfrom'])) ?> and <?php echo date("d-m-Y",strtotime($_POST['dtto'])) ?></h4>    

                   </div>
                   <div class="card-content">
                   <table>
							<thead>
								<tr>
									<th>Serial No.</th>
									<th>Item</th>
									<th>Cost</th>
									<th>Date</th>
								</tr>
							</thead>
							<tbody>
								<?php

									$dtexp = $getFromE->dtwise($_SESSION['UserId'],$_POST['dtfrom'],$_POST['dtto']);
									if($dtexp !== NULL)
									{
										$len = count($dtexp);
										for ($x = 1; $x <= $len; $x++) {
										echo "<tr>
											<td>".$x."</td>
											<td>".$dtexp[$x-1]->Item."</td>
											<td>"."₹ ".$dtexp[$x-1]->Cost."</td>
											<td>".date("d-m-Y",strtotime($dtexp[$x-1]->Date))."</td>
										</tr>";	
									  }
									}
														
								?>
                                
							</tbody>
						</table>
                   </div>
               </div>
           </div>
        </div>
</div>
