<?php session_start();
error_reporting(0);
include  'include/config.php'; 
if (strlen($_SESSION['adminid']==0)) {
  header('location:logout.php');
  } else{
$bookindid=$_GET['bookingid'];

if(isset($_POST['submit']))
{ 
  $bookingiid=$_POST['bookingiid'];
 $Paymenttype=$_POST['Paymenttype'];
 if($Paymenttype=='Full Payment'):
$ParcialPayment=$_POST['fullamount'];
else:
$ParcialPayment=$_POST['ParcialPayment'];
endif;
$tpay=$_POST['totalpayment'];
// if($tpay==''):
//   $totalpay=$ParcialPayment;
// else:
//   $totalpay=$tpay;
// endif;

$sql="INSERT INTO tblpayment(bookingID,paymentType,payment) Values(:bookindid,:Paymenttype,:ParcialPayment);
update tblbooking set paymentType=:Paymenttype where id=:bookindid";
$query = $dbh -> prepare($sql);
$query->bindParam(':bookindid',$bookingiid,PDO::PARAM_STR);
$query->bindParam(':Paymenttype',$Paymenttype,PDO::PARAM_STR);
$query->bindParam(':ParcialPayment',$ParcialPayment,PDO::PARAM_STR);
$query -> execute();
echo "<script>alert('Payment Details has been updated.');</script>";
echo "<script> window.location.href='booking-history.php';</script>";

}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a">
   <title>Booking Details</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
   <?php include 'include/header.php'; ?>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php include 'include/sidebar.php'; ?>
      <marquee onMouseOver="this.stop()" style="color: #e92f33;" onMouseOut="this.start()">This is a Code Camp BD's free source code for educational use only. It can never be used for commercial purposes. Don't forget to take code camp BD permission if needed!</marquee>

    <main class="app-content">
     	<!-- 


	- Author Name: MH RONY.
	- GigHub Link: https://github.com/dev-mhrony
	- Facebook Link:https://www.facebook.com/dev.mhrony
	- Youtube Link: <a href = "https://www.youtube.com/@codecampbdofficial"> Code Camp BD</a>
	- for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com
	- Visit My Website : https://dev-mhrony.com
	 -->
      
       <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <table class="table table-hover table-bordered">
                <thead>
                   <?php
                  $sql="SELECT t1.id as bookingid,t3.fname as Name, t3.email as email,t1.booking_date as bookingdate,t2.titlename as title,t2.PackageDuratiobn as PackageDuratiobn,
t2.Price as Price,t2.Description as Description,t4.category_name as category_name,t5.PackageName as PackageName,payment,paymentType FROM tblbooking as t1
 join tbladdpackage as t2
on t1.package_id =t2.id
join tbluser as t3
on t1.userid=t3.id
join tblcategory as t4
on t2.category=t4.id
join tblpackage as t5
on t2.PackageType=t5.id
 where t1.id=:bookindid";
                  $query= $dbh->prepare($sql);
                  $query->bindParam(':bookindid',$bookindid, PDO::PARAM_STR);
                  $query-> execute();
                  $results = $query -> fetchAll(PDO::FETCH_OBJ);
                  $cnt=1;
                  if($query -> rowCount() > 0)
                  {
                  foreach($results as $result)
                  {
                  ?>
                  <tr>
                   <th>Booking Date</th>
                   <td><?php echo $result->bookingdate; ?></td>
                    <th>Name</th>
                    <td><?php echo $result->Name; ?></td>
                  </tr>
                  <tr>
                   <th>Email</th>
                   <td><?php echo $result->email; ?></td>
                    <th>Category</th>
                    <td><?php echo $result->category_name; ?></td>
                  </tr>
                  <tr>
                   <th>Package Name:</th>
                   <td><?php echo $result->PackageName; ?></td>
                    <th>Title</th>
                    <td><?php echo $result->title; ?></td>
                  </tr>
                  <tr>
                   <th>Package Duratiobn</th>
                   <td><?php echo $result->PackageDuratiobn; ?></td>
                    <th>Price</th>
                    <td><?php echo $result->Price; ?></td>
                    <?php $pricess=$result->Price; ?>
                  </tr>
                  <tr>
                   <th>Description</th>
                   <td colspan="3"><?php echo $result->Description; ?></td>
                    
                  </tr>
             
                  <tr>
                   <th>PaymentType</th>
                   <td colspan="3"><?php echo $ptype=$result->paymentType; ?></td>
                    	<!-- 


	- Author Name: MH RONY.
	- GigHub Link: https://github.com/dev-mhrony
	- Facebook Link:https://www.facebook.com/dev.mhrony
	- Youtube Link: <a href = "https://www.youtube.com/@codecampbdofficial"> Code Camp BD</a>
	- for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com
	- Visit My Website : https://dev-mhrony.com
	 -->
                  </tr>
                  <?php  $cnt=$cnt+1; } } ?>
                </thead>
              </table>

            <?php   $sql="SELECT * from tblpayment
 where bookingID=:bookindid";
                  $query= $dbh->prepare($sql);
                  $query->bindParam(':bookindid',$bookindid, PDO::PARAM_STR);
                  $query-> execute();
                  $results = $query -> fetchAll(PDO::FETCH_OBJ);
                  $cnt=1;
                  if($query -> rowCount() > 0)
                  { ?>
                       <table class="table table-hover table-bordered">
                        <tr>
                          <th colspan="3" style="text-align:center;font-size:20px;">Payment History</th>
                        </tr>
                        <tr>
                          <th>Payment Type</th>
                          <th>Amount Paid</th>
                          <th>Payment Date</th>
                        </tr>
 <?php foreach($results as $result)
                  { ?>
<tr>
  <td><?php echo $result->paymentType; ?></td>
  <td><?php echo $tpayment=$result->payment; ?></td>
  <td><?php echo $result->payment_date; ?></td>
</tr>
<?php 
$gpayment+=$tpayment;
}  ?>
<tr>
  <th>Total</th>
  <th><?php echo $gpayment;?></th>
</tr>
	<!-- 


	- Author Name: MH RONY.
	- GigHub Link: https://github.com/dev-mhrony
	- Facebook Link:https://www.facebook.com/dev.mhrony
	- Youtube Link: <a href = "https://www.youtube.com/@codecampbdofficial"> Code Camp BD</a>
	- for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com
	- Visit My Website : https://dev-mhrony.com
	 -->

                       </table>
                     <?php } ?>
               <td>  
                <?php 
                if($ptype=='Full Payment')
                {
                  echo ' <button type="button" class="btn btn-primary" disabled="" data-toggle="modal" data-target="#myModal">Tack Action</button>';

                }
                else{
echo ' <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tack Action</button>';                }

               ?>
                	<!-- 


	- Author Name: MH RONY.
	- GigHub Link: https://github.com/dev-mhrony
	- Facebook Link:https://www.facebook.com/dev.mhrony
	- Youtube Link: <a href = "https://www.youtube.com/@codecampbdofficial"> Code Camp BD</a>
	- for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com
	- Visit My Website : https://dev-mhrony.com
	 -->       

                     </td>
            </div>
          </div>
        </div>
      </div>
    </main>
    <?php include_once 'include/footer.php' ?>
    <!-- Essential javascripts for application to work-->
     <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <!-- Data table plugin-->
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
  
  </body>
</html>

 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    	<!-- 


	- Author Name: MH RONY.
	- GigHub Link: https://github.com/dev-mhrony
	- Facebook Link:https://www.facebook.com/dev.mhrony
	- Youtube Link: <a href = "https://www.youtube.com/@codecampbdofficial"> Code Camp BD</a>
	- for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com
	- Visit My Website : https://dev-mhrony.com
	 -->
      <!-- Modal content-->
      <div class="modal-content">
        
        <div class="modal-body">
          <form method="post">
         <div class="row">
          <div class="col-md-12">
            <label>Payment Type</label>
            <select name="Paymenttype" id="Payment" class="form-control">
              <option value="">--select--</option>
              <option value="Partial Payment">Partial Payment</option>
              <option value="Full Payment">Full Payment</option>
            </select>
                <input type="hidden" name="bookingiid" id="bookingiid" value="<?php echo $bookindid; ?>">
            <br>
          </div>
           <div class="col-md-12" id="ParcialPay">
            <label>Partial Payment</label>
            <input type="text" name="ParcialPayment" id="ParcialPayment" class="form-control">
            <input type="hidden" name="totalpay" value="<?php echo $gpayment;?>">

              <br>
          </div>
             <input type="hidden" name="fullamount" value="<?php echo $pricess-$gpayment;?>">
         </div>
         <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
       </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
	<!-- 


	- Author Name: MH RONY.
	- GigHub Link: https://github.com/dev-mhrony
	- Facebook Link:https://www.facebook.com/dev.mhrony
	- Youtube Link: <a href = "https://www.youtube.com/@codecampbdofficial"> Code Camp BD</a>
	- for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com
	- Visit My Website : https://dev-mhrony.com
	 -->

  <script>
    $(document).ready(function(){
      $('#ParcialPay').hide();
      $('#Payment').change(function(){
        if($('#Payment').val()=='Partial Payment')
        {
          $('#ParcialPay').show();
        }
        else{
          $('#ParcialPay').hide();
        }

      });

    });
  </script>
  <?php } ?>	<!-- 


	- Author Name: MH RONY.
	- GigHub Link: https://github.com/dev-mhrony
	- Facebook Link:https://www.facebook.com/dev.mhrony
	- Youtube Link: <a href = "https://www.youtube.com/@codecampbdofficial"> Code Camp BD</a>
	- for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com
	- Visit My Website : https://dev-mhrony.com
	 -->