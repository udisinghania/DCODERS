<?php
include('serverdev.php');
$ID="";
$db=mysqli_connect('localhost','root','','devvsoc');


	if (isset($_POST['mobile'])) {
	$ID=1;
$_SESSION['PID']=$ID;
}
elseif (isset($_POST['laptop'])) {
 	$ID=2;
 	$_SESSION['PID']=$ID;
 } 
 elseif (isset($_POST['refg'])) {
 	$ID=3;
 	$_SESSION['PID']=$ID;
 }
 elseif (isset($_POST['ipad'])) {
 	$ID=4;
 	$_SESSION['PID']=$ID;
 }
else {
	$ID=$_SESSION['PID'];
}

if(isset($_POST['buy'])){
$pid=$_POST['buy'];
$employee_id=$_SESSION['employeeid'];
echo $employee_id;
	
	$getprice1="SELECT * FROM products where prodid='$pid'";
	$getprice2=mysqli_query($db,$getprice1);
	$getprice3=mysqli_fetch_assoc($getprice2);
	$price=$getprice3['prodprice'];

	$sql="SELECT * FROM transaction where prodid='$pid' and employee_id='$employee_id'";
	$que=mysqli_query($db,$sql);
    $res=mysqli_fetch_assoc($que);
if($res!=null){
echo "You cannot buy";
}
elseif($res==null){
	$tid=gen_uuid();
	
	$today = date("Y-m-d");
	$return_1=0;
	$snew = "INSERT INTO transaction (prodid,tid,return_1,date_1,prodprice,employee_id) VALUES ('$pid','$tid','$return_1','$today','$price','$employee_id')";
	$qnew2=mysqli_query($db,$snew);
if($qnew2){
	echo "Success";
}
else{
	echo "failure";
}
}

}
elseif (isset($_POST['return'])) {
$pid=$_POST['return'];

$ptid=$_POST['transid'];

$chk="SELECT * FROM transaction where prodid='$pid' and tid='$ptid'";
$chk2=mysqli_query($db,$chk);

$result=mysqli_fetch_assoc($chk2);
if($result!=null){
	$pdate=$result['date_1'];
	$today=date("Y-m-d");
	$pdate2=strtotime($pdate);
	$tdate2=strtotime($today);
	
	$diff=abs($tdate2-$pdate2);
	$years = floor($diff / (365*60*60*24));  
  
  
// To get the month, subtract it with years and 
// divide the resultant date into 
// total seconds in a month (30*60*60*24) 
$months = floor(($diff - $years * 365*60*60*24) 
                               / (30*60*60*24));  
  
  
// To get the day, subtract it with years and  
// months and divide the resultant date into 
// total seconds in a days (60*60*24) 
$days = floor(($diff - $years * 365*60*60*24 -  
             $months*30*60*60*24)/ (60*60*24)); 
	//$diff=date_diff($t,$pdate2);
 if($days<=30){
$gq="UPDATE transaction set return_1=1 where prodid='$pid'";
$gq2=mysqli_query($db,$gq);

if($gq2){
	echo "Return granted";
}
else{
	echo "Some error in returning product";
}
 }
 else{
 	echo "Return cannot be made after 30 days";
 }
	


}
elseif($result==null){
echo "You did not buy this product";
}

	
}


 $sql="SELECT * FROM products where top='$ID'";
 $records=mysqli_query($db,$sql);



?>

<!DOCTYPE html>
<html>
<head>
	<title>Items</title>
</head>
<body>
	<table align="center" border="5" cellpadding="5" cellspacing="5">
		<tr>
			<th>PRODUCT ID</th>
<th> Name</th>
<th>Price</th>
<th>Buy</th>
<th>Return</th>
		</tr>
		<?php
while($resmenu=mysqli_fetch_assoc($records)){
echo "<tr>";
echo "<td>".$resmenu['prodid']."</td>";
echo "<td>".$resmenu['prodname']."</td>";
echo "<td>".$resmenu['prodprice']."</td>";
echo "<form method='POST' action='list.php'>";
echo"<td><input type='submit' name='buy' value='".$resmenu['prodid']."'>Buy</td>"; 
echo"<td><input type='text' name='transid'><input type='submit' name='return' value='".$resmenu['prodid']."'>Return</td>"; 
echo "</form>";

echo "</tr>";
}

		?>
	</table>

</body>
</html>