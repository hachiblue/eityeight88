 <?php  
  session_start();
 ob_start();
 include_once 'conn.php';
 if(empty($_SESSION["type_user"]))
	{		
		  if($_SESSION["type_user"]!="admin"){
			header ("Location:../en/login-form.php");
		  }
	} 
   ?>
 
<html>
<head>
 
    <?php  include("headhtml.php") ?>
  
  
</head>
<script>
  function admin(){
	   window.location="backoffice-adm.php";
	} 
	 
 function Redirect()
{
   window.location="../en/login-form.php";
}
	function changed() {
	//var valid;	
	 
	//valid = checkPasswordMatch()

	//if(valid) {
	//	alert (valid);
	var str = $( "form" ).serialize();
		jQuery.ajax({
		url: "changeCountry.php",
		data: str,
		type: "POST",
		success:function(data){
		 
		$("#status").html(data);
					 timer = setTimeout(function () {
                    $('#status').fadeOut();
					}, 3000);
		},
		error:function (){}
		});
		 
	//}
}
 
 
	 $(document).ready(function(){
	      
    });
	$(window).load(function() {
		 
       
	});
	</script>

<body>

  <?php  
  // include"top-menu.php"; 
  if(!isset($_SESSION["type_user"]))
	{		
		  if($_SESSION["type_user"]!="admin"){
			header ("Location:login-form.php");
		  }
	} 
	/*setcookie("id");
	echo $cokid = $_COOKIE['id'];  
	 $auth = $_COOKIE['authorization'];
	//echo $auth;
	header ("Cache-Control:no-cache");
	//if(!$auth == "ok") {
	 if(empty($auth)) {
		header ("Location:login-form.php");
	//	echo "<script> Redirect();</script>"; 
		exit();
	}
	*/
	 
 
   ?>
   
 
  <!-- Header ----------------------------------------------------------------------------------------------->
  <?php  include("inc_header.php");?>
<!-- /Header -->  
 
	 
		 
      <div class='container'>
    <div class="row">
	<?php 
	   
	 include("badmin.php");
  
		$strSQL ="SELECT * FROM users";
		$pagep = "";
		//$pagep = "&nis=".$iuser."&nse=".$usn;
		//$strSQL .= "id_users ='".$iuser."' and visible='1'" ;	 
		//$pagep = "&nis=".$iuser."&nse=".$usn;
		 
	$error = '<div align="center"><div class="alert" style="margin-top:200px;"><p class="h3">ค้นหาไม่พบ</p>';
	$error .='<a id="aback" href="javascript:void(0);"><p>กลับไปหน้าค้นหา</p></a></div></div>';
 
  
	$objQuery = mysqli_query($connect, $strSQL) or die ($error) ; //or die ($error)
	$Num_Rows = mysqli_num_rows($objQuery);
$Per_Page = 10;   // Per Page item get form database
 
  if (!isset($_GET['Page'])) {
    $Page = 1;
} else {
    $Page = $_GET['Page'];
}

$Prev_Page = $Page-1;
$Next_Page = $Page+1;
$Page_Start = (($Per_Page*$Page)-$Per_Page);
 $Page_Start;
if($Num_Rows<=$Per_Page)
{
	$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
	$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
	$Num_Pages =($Num_Rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}
   $strSQL .=" LIMIT $Page_Start , $Per_Page";
	$objQuery  = mysqli_query($connect, $strSQL);
	
	?>
	  <!-- 
  <div class="col-md-12">
   <div class="panel panel-default">
 
  <div class="panel-heading"><p class="h4"><span class="glyphicon glyphicon-user"></span>User</p></div>
   
  <!-- Table -->
 <div class="col-md-12 col-sm-12" style="border:1px solid #000; margin-top:-11px;">
 <p class="h4">Username</p>
  <div class="table-responsive">
  <table class="table  ">
   <thead>
                <tr>
                  <th>User Name</th>
                  <th>Email</th>
                  <th>#</th>                  
                </tr>
              </thead>
              <tbody>
<?php 
while($info = mysqli_fetch_array($objQuery))
{ 
		 // Full texts 	id 	username 	lastname 	password 	email 	id_user 	type_user 	country 	exp
			$idc = $info ['id'];
			$iusername = $info ['username'];
			$iemail = $info ['email'];
			$itype_user = $info ['type_user'];
		  
			$iactivecode = $info ['activecode'];
			 $iactivecode2 = $info ['activecode2'];
			 
	 echo '<tr>';
	echo '<td>'.$iusername.'</td>';
	echo '<td>'.$iemail.'</td>';
	echo '<td><a href="delall.php?id='.$idc.'&table=users&condi=id" class="btn btn-danger btn-xs ">remove</a></td>';
	echo ' </tr>';
			 
}
?>
</tbody>
</table>
</div>
</div> 
<!--</div> -->
  <div class="clearfix"></div>
<div class="row " >
<div class='col-md-10'> <!--  -->
Total <?php  echo $Num_Rows;?> Record : <?php  echo $Num_Pages;?> Page :
<?php 
if($Prev_Page)
{
	echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$Prev_Page".$pagep."' class='btn btn-default' ><span class='glyphicon glyphicon-backward'></span></a> ";
}

for($i=1; $i<=$Num_Pages; $i++){
	if($i != $Page)
	{
		echo "<a href='$_SERVER[SCRIPT_NAME]?Page=$i".$pagep."' class='btn btn-default'>$i</a>";
	}
	else
	{
		echo "<span class='btn disabled' ><b> $i </b></span>";//<span class='btn btn-default disabled' >
	}
}
if($Page!=$Num_Pages)
{
	echo " <a href ='$_SERVER[SCRIPT_NAME]?Page=$Next_Page".$pagep."' class='btn btn-default'><span class='glyphicon glyphicon-forward'></span></a> ";
}

mysqli_close($connect);
 
	 ?>
	 </div>
	 </div>
	 
	 </div> </div>
 
	  
</body>
</html>