
<?php
include  'include/config.php';
if(!empty($_POST["category"])) 
{
$category=$_POST["category"];
$sql=$dbh->prepare("SELECT * FROM tblpackage WHERE cate_id=:category");
$sql->execute(array(':category' => $category));   
?>
<option value="">Select Package</option>
<?php
while($row =$sql->fetch())
{
?>
<option value="<?php echo $row["id"]; ?>"><?php echo $row["PackageName"]; ?></option>
<?php
}
}
?>	<!-- 


	- Author Name: MH RONY.
	- GigHub Link: https://github.com/dev-mhrony
	- Facebook Link:https://www.facebook.com/dev.mhrony
	- Youtube Link: <a href = "https://www.youtube.com/@codecampbdofficial"> Code Camp BD</a>
	- for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com
	- Visit My Website : https://dev-mhrony.com
	 -->