
<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['aid'])==0)
    {   
header('location:index.php');
}
else{
date_default_timezone_set('Asia/Kolkata');
$currentTime = date( 'd-m-Y h:i:s A', time () );


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Between Dates Complaints Report</title>
    <link rel="stylesheet" href="assets/css/style.css">
 <script language="javascript" type="text/javascript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
 if(popUpWin)
{
if(!popUpWin.closed) popUpWin.close();
}
popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}
</script>   
</head>
<body class="">
	<?php include('include/sidebar.php');?>
	<?php include('include/header.php');?>
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Between Dates Grievances Report</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="between-date-complaintreport.php">Between Dates Grievances Report</a></li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                 
                    <div class="card-body">
                        <h5>Between Dates Complaints Report</h5>
                        <hr>
                       <div class="card-body">
<form  method="post" onsubmit="return validateDates()">                                
<div class="row">
<div class="col-2">From Date</div>
<div class="col-4"><input type="date"  name="fromdate" id="fromdate" class="form-control" required></div>
</div>

<div class="row" style="margin-top:1%;">
<div class="col-2">To Date</div>
<div class="col-4"><input type="date"  name="todate" id="todate" class="form-control" required></div>
</div>

<div class="row" style="margin-top:1%;">
<div class="col-6" align="center"><button type="submit" name="submit" class="btn btn-primary">Submit</button></div>
</div>

</form>
                            </div>
                      <div class="row">
                            <div class="col-xl-12">
                <div class="card">
                   <?php if (isset($_POST['submit'])) { 
$fdate=$_POST['fromdate'];
$tdate=$_POST['todate'];
?>
<br>
     <h4 align="center" style="color:blue">Orders Report Form <?php echo $fdate;?> To <?php echo $tdate;?></h4>
<hr />
                    <div class="card-body table-border-style" >
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                        <tr><th>S.No</th>
											<th>Complaint No</th>
											<th>Complainant Name</th>
											<th>Reg Date</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
                                </thead>
                                <tbody>
                                    <?php 

$query=mysqli_query($con,"select tblcomplaints.*,users.fullName as name from tblcomplaints join users on users.id=tblcomplaints.userId where tblcomplaints.regDate between '$fdate' and '$tdate'");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>  
                                        <tr>
                                            <td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($row['complaintNumber']);?></td>
                                            <td><?php echo htmlentities($row['name']);?></td>
                                            <td> <?php echo htmlentities($row['regDate']);?></td>
                                                                                                              <td>
                                                <?php $status=$row['status'];
                                                if($status==''): ?>
                                                <span class="badge badge-danger">Not Processed Yet</span>
                                            <?php elseif($status=='in process'):?>
                                             <span class="badge badge-warning">In Process</span>
                                         <?php elseif($status=='closed'):?>
                                             <span class="badge badge-success">Closed</span>
                                         <?php endif;?>
</td>
<td>   <a href="complaint-details.php?cid=<?php echo htmlentities($row['complaintNumber']);?>" class="btn btn-primary"> View Details</a> 
											</td>
                                        </td>
                                        </tr>
                                        <?php $cnt=$cnt+1; } ?>
                                </tbody>
                            </table><?php } ?>
                        </div>
                    </div>
                </div>
            </div>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    
    <!-- VALIDATION FOR DATES -->
    <script>
    function validateDates() {
        const fromDate = document.getElementById('fromdate').value;
        const toDate = document.getElementById('todate').value;

        if (new Date(fromDate) > new Date(toDate)) {
            alert('From Date cannot be greater than To Date.');
            return false; 
        }
        return true; 
    }
    </script>
</body>
</html>
<?php } ?>