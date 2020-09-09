<?php 
    include_once "init.php";
    if ($getFromU->loggedIn() === false) {
        header('Location: 1-login.php');
    }
    include_once 'skeleton.php'; 
    
    //checker function
    $g = $getFromB->checker($_SESSION['UserId']);
    if($g == false)
    {
        $getFromB->delrecord($_SESSION['UserId']);
    }

    //Today
    $today = $getFromE->EXPENSES($_SESSION['UserId'],0);
    if($today == NULL)
    {
        $today = "No Expenses Logged Today";
    }
    else
    {
        $today = "₹ ".$today;
    }

    //Yesterday
    $Yester = $getFromE->Yesterday($_SESSION['UserId']);
    if($Yester == NULL)
    {
        $Yester = "No Expenses Logged Yesterday";
    }
    else
    {
        $Yester = "₹ ".$Yester;
    }

    //Last 7 Days 
    $week = $getFromE->EXPENSES($_SESSION['UserId'],6);
    if($week == NULL)
    {
        $week = "No Expenses Logged This Week";
    }
    else
    {
        $week = "₹ ".$week;
    }

    //Last 30 Days
    $month = $getFromE->EXPENSES($_SESSION['UserId'],29);
    if($month == NULL)
    {
        $month = "No Expenses Logged This Month";
    }
    else
    {
        $month = "₹ ".$month;
    }

    //Total Expenses
    $total = $getFromE->totalexp($_SESSION['UserId']);
    if($total == NULL)
    {
        $total = "No Expenses Logged Yet";
    }
    else
    {
        $total = "₹ ".$total;
    }


    //Budget

    $v = $getFromB->checkbudget($_SESSION['UserId']);
    if($v == NULL)
    {
        $v = "Not Set Yet";
    }
    else
    {
        $currmonexp = $getFromE->thismonth($_SESSION['UserId']);
        if($currmonexp==NULL)
        {
            $currmonexp = 0;
        }
        $v = $v - $currmonexp;
        $v = "₹ ".$v;
    }

?>
    <div class="wrapper">
        <div class="row">
            <div class="col-6 col-m-6 col-sm-6">
                <div class="card">
                    <div class="counter bg-danger">
                        <p><i class="fas fa-tasks"></i></p>
                        <h3>
                            Today's Expenses
                        </h3>
                        <p style="font-size: 1.2em;">
                            <?php echo $today ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-m-6 col-sm-6">
                <div class="card">
                    <div class="counter bg-primary">
                        <p><i class="fas fa-spinner"></i></p>
                        <h3>
                            Yesterday's Expenses
                        </h3>
                        <p style="font-size: 1.2em;">
                            <?php echo $Yester ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-m-6 col-sm-6">
                <div class="card">
                    <div class="counter bg-warning">
                        <p><i class="fas fa-calendar-week"></i></p>
                        <h3>
                            Last 7 day's Expenses
                        </h3>
                        <p style="font-size: 1.2em;">
                            <?php echo $week ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-m-6 col-sm-6">
                <div class="card">
                    <div class="counter bg-success">
                        <p><i class="fas fa-calendar"></i></p>
                        <h3>
                            Last 30 day's Expenses
                        </h3>
                        <p style="font-size: 1.2em;">
                            <?php echo $month ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-m-6 col-sm-6">
                <div class="card">
                    <div class="counter bg-danger bg-vio">
                        <p><i class="fas fa-rupee-sign"></i></p>
                        <h3>
                            Monthly Budget Left
                        </h3>
                        <p style="font-size: 1.2em;">
                            <?php echo $v ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-m-6 col-sm-6">
                <div class="card">
                    <div class="counter bg-yell">
                        <p><i class="fa fa-calculator" aria-hidden="true"></i></p>
                        <h3>
                            Total Expenses
                        </h3>
                        <p style="font-size: 1.2em;">
                            <?php echo $total ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>