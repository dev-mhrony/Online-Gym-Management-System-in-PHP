<?php session_start();
error_reporting(0);
require_once('include/config.php');
if(strlen( $_SESSION["uid"])==0)
    {   
header('location:login.php');
}
else{
$uid=$_SESSION['uid'];
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>User | Booking History</title>
	<meta charset="UTF-8">
	<meta name="description" content="Ahana Yoga HTML Template">
	<meta name="keywords" content="yoga, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="css/nice-select.css"/>
	<link rel="stylesheet" href="css/slicknav.min.css"/>

	<!-- Main Stylesheets -->
	<link rel="stylesheet" href="css/style.css"/>

</head>
<body>
	<!-- Page Preloder -->
	

	<!-- Header Section -->
	<?php include 'include/header.php';?>
	<!-- Header Section end -->
	                                                                              
	<!-- Page top Section -->
	<section class="page-top-section set-bg" data-setbg="img/page-top-bg.jpg">
		<div class="container">
			<div class="row">
				<div class="col-lg-7 m-auto text-white">
					<h2>Booking History</h2>
					
				</div>
			</div>
		</div>
	</section>
	<!-- Page top Section end -->

	<!-- Contact Section -->
	<section class="contact-page-section spad overflow-hidden">
		<div class="container">
			
			<div class="row">
				
				<div class="col-lg-12">
					<table class="table table-bordered">
    <thead>
      <tr>
        <th>Sr.No</th>
        <th hidden>bookingid</th>
        <th hidden>Name</th>
        <th hidden>email</th>
        <th>bookingdate</th>
        <th>title</th>
        <th>PackageDuratiobn</th>
        <th>price</th>
        <th>Description</th>
        <th>category_name</th>
        <th>PackageName</th>
        <th>Action</th>


      </tr>
    </thead>
          <?php
          $uid=$_SESSION['uid'];
                  /*$sql="select id, product_id, userid, product_title, packages, category, PackageDuratiobn, price, descripation, booking_date from tblbooking where userid=:uid";*/
                  $sql="SELECT t1.id as bookingid,t3.fname as Name, t3.email as email,t1.booking_date as bookingdate,t2.titlename as title,t2.PackageDuratiobn as PackageDuratiobn,
t2.Price as Price,t2.Description as Description,t4.category_name as category_name,t5.PackageName as PackageName FROM tblbooking as t1
 join tbladdpackage as t2
on t1.package_id =t2.id
join tbluser as t3
on t1.userid=t3.id
join tblcategory as t4
on t2.category=t4.id
join tblpackage as t5
on t2.PackageType=t5.id
where t1.userid=:uid";
                  $query= $dbh->prepare($sql);
                  $query->bindParam(':uid',$uid, PDO::PARAM_STR);
                  $query-> execute();
                  $results = $query -> fetchAll(PDO::FETCH_OBJ);
                  $cnt=1;
                  if($query -> rowCount() > 0)
                  {
                  foreach($results as $result)
                  {
                  ?>

                <tbody>
                  <tr>
                    <td><?php echo($cnt);?></td>
                    <td hidden><?php echo htmlentities($result->bookingid);?></td>
                    <td hidden><?php echo htmlentities($result->Name);?></td>
                    <td hidden><?php echo htmlentities($result->email);?></td>
                    <td><?php echo htmlentities($result->bookingdate);?></td>
                    <td><?php echo htmlentities($result->title);?></td>
                    <td><?php echo htmlentities($result->PackageDuratiobn);?></td>
                    <td><?php echo $result->Price;?></td>
                    <td><?php echo $result->Description;?></td>
                    <td><?php echo htmlentities($result->category_name);?></td>
                    <td><?php echo htmlentities($result->PackageName);?></td>
                    <td><a href="booking-details.php?bookingid=<?php echo htmlentities($result->bookingid);?>"><button class="btn btn-primary" type="button">View</button></td>
                  </tr>
                    <?php  $cnt=$cnt+1; } } ?>
              
                </tbody>
  </table>
				</div>
			
			</div>
		</div>
	</section>
	<!-- Trainers Section end -->



	<!-- Footer Section -->
<?php include 'include/footer.php'; ?>
	<!-- Footer Section end -->
	
	<div class="back-to-top"><img src="img/icons/up-arrow.png" alt=""></div>

	<!--====== Javascripts & Jquery ======-->
	<script src="js/vendor/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.slicknav.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/main.js"></script>

	</body>
</html>
 <style>
.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #dd3d36;
    color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #5cb85c;
    color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
        </style>
        <?php } ?>