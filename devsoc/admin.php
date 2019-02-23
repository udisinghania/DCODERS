<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="stylesheet" type="text/css" media="screen" href="main.css" />-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
        var call;
        $.ajax({url:"http://localhost/devsoc_api/api/payment/read.php", success:function(result){
            $("#div1").html(result.data[0].id);
             call=result.data[0].id;
            console.log(result.data[0].id);
          
        }});
        
    });
   
   <?php $ttid=call;?>
</script>
<!--script>
var mysql      = require('sql');
var connection = mysql.createConnection({
  host     : 'localhost',
  user     : 'root',
password : '',
  database : 'devvsoc'
});

connection.connect();
connection.query('SELECT * from transaction ', function(err, rows, fields) {
  if (!err)
    console.log('The solution is: ', rows);
  else
    console.log('Error while performing Query.');
});

connection.end();

</script>-->
</head>
<body>
<form method="get" action="admin.php">
    <div id="div1"></div>
</form>
<?php


$db = mysqli_connect('localhost', 'root', '', 'devvsoc');
$sql="SELECT * FROM transaction WHERE tid= '$ttid'";
$query1=mysqli_query($db,$sql);
$result1=mysqli_fetch_assoc($query1);
echo $result1['tid'];
?>
</body>
</html>

