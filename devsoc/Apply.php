<?php
$db = mysqli_connect('localhost', 'root', '', 'payment_portal');
 $today=date("m-d-Y");
        echo "You applied for reimburment on " . $today. "<br>";

        if(isset($_POST['submit'])){
            $tid=$_POST['Transaction'];
            $amount=$_POST['Amount'];
            echo "$tid";
            echo "$amount";
$sql="INSERT INTO payment1(id,amount) VALUES('$tid','$amount')";
$quer=mysqli_query($db,$sql);
if($quer)
{
    echo "Succcess";
}
else{
echo "not updated";
}
        }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Apply</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="Apply.css" />
    <script src="Apply.js"></script>
</head>
<body>
   <form method="POST" action="Apply.php">
       <table>
           <tr>
       <td> Transaction id:</td>
      <td> <input type = "text" name = "Transaction" class = " "></td></tr>
      <tr> <td>Amount:</td>
      <td> <input type = "text" name = "Amount" class = " "></td></tr>
      
</table>
       <button type = "submit" name = "submit" class = " " >Apply</button><br> 
</form>

</body>
</html> 