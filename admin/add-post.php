<?php session_start();
error_reporting(0);
include  'include/config.php'; 
if (strlen($_SESSION['adminid']==0)) {
  header('location:logout.php');
  } else{
include  'include/config.php';
if(isset($_POST['Submit'])){

$category = $_POST['category'];
$titlename = $_POST['titlename'];$package = $_POST['package'];$packageduratiobn = $_POST['packageduratiobn'];$Price = $_POST['Price'];$photo = $_POST['photo'];$description = $_POST['description'];

$sql="INSERT INTO tbladdpackage (category,titlename,PackageType,PackageDuratiobn,Price,uploadphoto,Description) 
Values(:category,:titlename,:package,:packageduratiobn,:Price,:photo,:description)";
$query = $dbh -> prepare($sql);
$query->bindParam(':category',$category,PDO::PARAM_STR);
$query->bindParam(':titlename',$titlename,PDO::PARAM_STR);
$query->bindParam(':package',$package,PDO::PARAM_STR);
$query->bindParam(':packageduratiobn',$packageduratiobn,PDO::PARAM_STR);
$query->bindParam(':Price',$Price,PDO::PARAM_STR);
$query->bindParam(':photo',$photo,PDO::PARAM_STR);
$query->bindParam(':description',$description,PDO::PARAM_STR);
$query -> execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId>0)
{
echo "<script>alert('Package Added successfully.');</script>";
echo "<script> window.location.href='manage-post.php';</script>";
 }
else {

$errormsg= "Data not insert successfully";
 }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a">
   <title>Admin | Add Package</title>
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
      <h3> Add Package </h3>
      <hr/>
      <div class="row">
        	<!-- 


	- Author Name: MH RONY.
	- GigHub Link: https://github.com/dev-mhrony
	- Facebook Link:https://www.facebook.com/dev.mhrony
	- Youtube Link: <a href = "https://www.youtube.com/@codecampbdofficial"> Code Camp BD</a>
	- for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com
	- Visit My Website : https://dev-mhrony.com
	 -->
        <div class="col-md-12">
          <div class="tile">
             <!---Success Message--->  
          <?php if($msg){ ?>
          <div class="alert alert-success" role="alert">
          <strong>Well done!</strong> <?php echo htmlentities($msg);?>
          </div>
          <?php } ?>

          <!---Error Message--->
          <?php if($errormsg){ ?>
          <div class="alert alert-danger" role="alert">
          <strong>Oh snap!</strong> <?php echo htmlentities($errormsg);?></div>
          <?php } ?>
            <div class="tile-body">
              <form class="row" method="post">
                <div class="form-group col-md-6">
                  <label class="control-label">Category</label>
                 <select name="category" id="category" class="form-control" onChange="getdistrict(this.value);">
                  <option value="NA">--select--</option>
                  <?php 
                  $stmt = $dbh->prepare("SELECT * FROM tblcategory ORDER BY category_name");
                  $stmt->execute();
                  $countriesList = $stmt->fetchAll();
                  foreach($countriesList as $country){
                  echo "<option value='".$country['id']."'>".$country['category_name']."</option>";
                  }
                  ?>
                  </select>
                 </select>
                </div>
                 <div class="form-group col-md-6">
                  <label class="control-label">Package Type</label>
                   <select name="package" id="package" class="form-control">
                   <option value="NA">--select--</option>
                 </select>
                </div>
	<!-- 


	- Author Name: MH RONY.
	- GigHub Link: https://github.com/dev-mhrony
	- Facebook Link:https://www.facebook.com/dev.mhrony
	- Youtube Link: <a href = "https://www.youtube.com/@codecampbdofficial"> Code Camp BD</a>
	- for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com
	- Visit My Website : https://dev-mhrony.com
	 -->
                <div class="form-group col-md-6">
                  <label class="control-label">Title Name</label>
                  <input class="form-control" name="titlename" id="titlename" type="text" placeholder="Enter your Title Name">
                </div>

               

                 <div class="form-group col-md-6">
                  <label class="control-label">Package Duration</label>
                  <input class="form-control" type="text" name="packageduratiobn" name="packageduratiobn" placeholder="Enter Package Duratiobn">
                </div>

                 <div class="form-group col-md-6">
                  <label class="control-label">Price</label>
                  <input class="form-control" type="text" name="Price" id="Price" placeholder="Enter your Price">
                </div>

                  <div class="form-group col-md-6">
                  <label class="control-label">Description</label>
                  <textarea name="description" id="description" class="form-control" cols="5" rows="10"></textarea> 
                </div>

                <div class="form-group col-md-4 align-self-end">
                  <input type="Submit" name="Submit" id="Submit" class="btn btn-primary" value="Submit">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </main>	<!-- 


	- Author Name: MH RONY.
	- GigHub Link: https://github.com/dev-mhrony
	- Facebook Link:https://www.facebook.com/dev.mhrony
	- Youtube Link: <a href = "https://www.youtube.com/@codecampbdofficial"> Code Camp BD</a>
	- for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com
	- Visit My Website : https://dev-mhrony.com
	 -->
    <?php include_once 'include/footer.php' ?>
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/plugins/pace.min.js"></script>
  <script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      
  </body>
</html>

<!-- Script -->
 <script>
function getdistrict(val) {
$.ajax({
type: "POST",
url: "ajaxfile.php",
data:'category='+val,
success: function(data){
$("#package").html(data);
}
});
}
</script>
<?php } ?>	<!-- 


	- Author Name: MH RONY.
	- GigHub Link: https://github.com/dev-mhrony
	- Facebook Link:https://www.facebook.com/dev.mhrony
	- Youtube Link: <a href = "https://www.youtube.com/@codecampbdofficial"> Code Camp BD</a>
	- for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com
	- Visit My Website : https://dev-mhrony.com
	 -->