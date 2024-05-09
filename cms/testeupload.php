<?php
	ini_set('display_errors', true);
	include "include/parametros.php";	
	include "include/_config.php";
	$dadosUsuario	=	$_SESSION['exp_user'];
	require_once("login.class.php");
	$login = new Login();
	$login->verificar("login.php");
?>

<?php
// //initialize the session
// if (!isset($_SESSION)) {
//   session_start();
// }
// // ** Logout the current user. **
// $logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
// if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
//   $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
// }
// if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
//   //to fully log out a visitor we need to clear the session varialbles
//   $_SESSION['MM_Username'] = NULL;
//   $_SESSION['MM_UserGroup'] = NULL;
//   $_SESSION['PrevUrl'] = NULL;
//   unset($_SESSION['MM_Username']);
//   unset($_SESSION['MM_UserGroup']);
//   unset($_SESSION['PrevUrl']);
// 	
//   $logoutGoTo = "index.php";
//   if ($logoutGoTo) {
//     header("Location: $logoutGoTo");
//     exit;
//   }
// }
?>
<?php
// if (!isset($_SESSION)) {
//   session_start();
// }
// $MM_authorizedUsers = "";
// $MM_donotCheckaccess = "true";
// // *** Restrict Access To Page: Grant or deny access to this page
// function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
//   // For security, start by assuming the visitor is NOT authorized. 
//   $isValid = False; 
//   // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
//   // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
//   if (!empty($UserName)) { 
//     // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
//     // Parse the strings into arrays. 
//     $arrUsers = Explode(",", $strUsers); 
//     $arrGroups = Explode(",", $strGroups); 
//     if (in_array($UserName, $arrUsers)) { 
//       $isValid = true; 
//     } 
//     // Or, you may restrict access to only certain users based on their username. 
//     if (in_array($UserGroup, $arrGroups)) { 
//       $isValid = true; 
//     } 
//     if (($strUsers == "") && true) { 
//       $isValid = true; 
//     } 
//   } 
//   return $isValid; 
// }
// $MM_restrictGoTo = "index.php";
// if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
//   $MM_qsChar = "?";
//   $MM_referrer = $_SERVER['PHP_SELF'];
//   if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
//   if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
//   $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
//   $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
//   header("Location: ". $MM_restrictGoTo); 
//   exit;
// }
// $con=mysql_connect("localhost", "xxxxxxxxxxx", "xxxxxxxxxxx")or die("cannot connect");
// mysql_select_db("xxxxxxxxxxxxxxxx",$con)or die("cannot select DB");
if(isset($_POST['upload']))
{	
	$img=$_FILES["image"]["name"];
	foreach($img as $key => $value)
	{
		$name=$_FILES["image"]["name"][$key] ;
		$tname=$_FILES["image"]["tmp_name"][$key];
		$size=$_FILES["image"]["size"][$key];
		$oext=getExtention($name);
		$ext=strtolower($oext);
		$base_name=getBaseName($name);
		if($ext=="jpg" || $ext=="jpeg" || $ext=="bmp" || $ext=="gif"){
			if($size< 1024*1024){
				if(file_exists("uploaded_images/".$name)){
					move_uploaded_file($tname,"uploaded_images/".$name);
					$result = 1;
					list($width,$height)=getimagesize("uploaded_images/".$name);
					$qry="select Testimonial_Id from testimonials where `img_base_name`='$base_name' and `img_ext`='$ext'";
					$res=mysql_fetch_array(mysql_query($qry));
					$id=$res['Testimonial_Id'];
					$qry="UPDATE testimonials SET `img_base_name`='$base_name' ,`img_ext`='$ext' ,`img_height`='$height' ,`img_width`='$width' ,`size`='$size' ,`img_status`='Y' where Testimonial_Id=$id";
					
					mysql_query($qry);
					echo "Image '$name' updated";
				}
				else{
					move_uploaded_file($tname,"images/teste/".$name);
					$result = 1;
					list($width,$height)=getimagesize("images/teste/".$name);
				  mysql_real_escape_string($_POST['customername']);
                  mysql_real_escape_string($_POST['town']);
                  mysql_real_escape_string($_POST['testimonial']);
                  mysql_real_escape_string($_POST['sort_order']);
				  
					$qry="INSERT INTO testimonials(`Testimonial_Id` ,'CustomerName' ,'Town' ,'Testimonial' ,'SortOrder' ,`img_base_name` ,`img_ext` ,`img_height` ,`img_width`, `size` ,`img_status`)VALUES ('' , 'customername' , 'town' , 'testimonial' , 'sort_order' , '$base_name', '$ext', '$height', '$width', '$size', 'Y');";
				  
					mysql_query($qry);
					echo "Image '$name' uploaded";
				}
			}
			else{
				echo "Image size excedded.File size should be less than 1Mb";
			}
		}
		else{
			echo "Invalid file extention '.$oext'";
		}
	}	
}
function getExtention($image_name){
	return substr($image_name,strrpos($image_name,'.')+1);
}
function getBaseName($image_name){
	return substr($image_name,0,strrpos($image_name,'.'));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="testimonials.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function addItems()
{
var table1 = document.getElementById('tab1');
var newrow = document.createElement("tr");
var newcol = document.createElement("td");
var input = document.createElement("input");
input.type="file";
input.name="image[]";
newcol.appendChild(input);
newrow.appendChild(newcol);
table1.appendChild(newrow);
}
function remItems()
{
var table1 = document.getElementById('tab1');
var lastRow = table1.rows.length;
if(lastRow>=2)
table1.deleteRow(lastRow-1);
}
</script>
<style type="text/css">
a.tooltip:hover span{display:inline; position:absolute; border:2px solid #cccccc; background:#efefef; color:#333399;}
a.tooltip span
{display:none; padding:2px 3px; margin-left:8px; width:150px;}
</style>
</head>
<body>
<p align="center">&nbsp;</p>
<form method="post" action="" enctype="multipart/form-data">
  <p>&nbsp;</p>
  <p align="center">
    <label for="customername">Customer Name:</label>
    <input name="customername" type="text" id="customername" maxlength="150" value="<?php echo $_POST['customername']; ?>" />
  </p>
  <p align="center">
    <label for="town">Town/City:   </label>
    <input name="town" type="text" id="town" maxlength="150" value="<?php echo $_POST['town']; ?>" />
  </p>
  <p align="center">
    <label for="testimonial"><u>Testimonial </u></label>
  </p>
  <p align="center">
    <textarea name="testimonial" id="testimonial" cols="60" rows="10"><?php echo $_POST['testimonial']; ?></textarea>
  </p>
  <p align="center">
    <label for="sort_order">Sort Order: </label>
    <input name="sort_order" type="text" id="sort_order" size="10" maxlength="3" value="<?php echo $_POST['sort_order']; ?>" />
  </p>
<table align="center" border="0" id="tab1">
	<tr>
    	<td width="218" align="center"><input type="file" name="image[]" /></td>
		<td width="54" align="center"><img src="images/add_icon.jpg" alt="Add" style="cursor:pointer" onclick="addItems()" /></td>
        <td><img src="images/remove_icon.jpg" alt="Remove" style="cursor:pointer" onclick="remItems()" /></td>
	</tr>
</table>
<table align="center" border="0" id="tab2">
<tr><td align="center"><input type="submit" value="Upload" name="upload" /></td></tr>
</table>
</form>
<table border="0" style="border:solid 1px #333; width:800px" align="center"><tr><td align="center">
<iframe style="display:none" name="if1" id="if1"></iframe>
<?
$qry="select * from testimonials where img_status='Y' order by Testimonial_Id";
$res=mysql_query($qry);
$i=0;
if(mysql_num_rows($res)){ ?>
<div align="center"><ul style="width:650px; border: 0px">
<?
while($fetch=mysql_fetch_array($res)){
	$hratio=120/$fetch['img_height'];
	$wratio=120/$fetch['img_width'];
	$ratio=($hratio < $wratio) ? $hratio : $wratio;
	$hth=$fetch['img_height']*$ratio;
	$wth=$fetch['img_width']*$ratio;
?>
<li style="width:120px; height:180px; border:0px solid #333;float:left;list-style:none outside none; padding-right:5px;">
	<img src="uploaded_images/<? echo $fetch['img_base_name'].'.'.$fetch['img_ext']; ?>" width="<? echo $wth; ?>" height="<? echo $hth; ?>" title="<? echo "image : ".$fetch['img_base_name'].".".$fetch['img_ext']; ?>" />
<?
	if($i==0)
		$fp=fopen("fileInfo.txt",'w');
	else
		$fp=fopen("fileInfo.txt",'a');
	fwrite($fp,"Image : ".++$i ."\r\n");
	fwrite($fp,"Name : ".$fetch['img_base_name'].".".$fetch['img_ext']."\r\n");
	fwrite($fp,"width X height :
 ".$fetch['img_width']." X ".$fetch['img_height']."\r\n");
	fwrite($fp,"Size : ".round($fetch['size']/1024,1)."Kb\r\n");
	fwrite($fp,"____________________________________\r\n");
	fclose($fp);
echo $fetch['img_base_name'].".".$fetch['img_ext'].'';
echo $fetch['img_width'].' X ';
echo $fetch['img_height'].'';
echo round($fetch['size']/1024,1) .'Kb';
?>
</li>
<?
}?>
</ul>
</div><? }?>
</td></tr></table>
</body>
</html>