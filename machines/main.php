<?php
include("session.php");
?>



<script type="text/javascript">
<!--
var timeLeft = 0;
var begin
//get input hours, minutes, seconds
var hours   = <?php echo json_encode($washerin_hours1); ?>;
var minutes = <?php echo json_encode($washerin_minutes1); ?>;
var seconds = 0;

   //calculate time left in seconds
timeLeft = (hours * 3600) + (minutes * 60) + seconds;

//start count down timer
begin=setInterval("countDown()",1000);

function countDown()  
{
	var hoursLeft   = 0;
  	var minutesLeft = 0;
   	var secondsLeft = 0;
   	var remainder   = 0;

 	timeLeft = timeLeft-1;

    	if(timeLeft >= 0)
    	{
   		//break down time left into hours, minutes, seconds
  		hoursLeft = Math.floor(timeLeft/3600);
 	 	remainder = timeLeft%3600;

  		minutesLeft = Math.floor(remainder/60);
  		remainder   = remainder%60;

  		secondsLeft = remainder;
          document.getElementById('cellHours').innerHTML = hoursLeft;
 		document.getElementById('cellMinutes').innerHTML = minutesLeft;
 		document.getElementById('cellSeconds').innerHTML = secondsLeft; 
    	} 
    	else 
    	{
     	clearInterval(begin);
    	}  
    	var mysql = require('mysql');

   var con = mysql.createConnection({
      host: "localhost",
      user: "root",
      password: "",
      database: "laundry"
      });

   con.connect(function(err) 
   {
      if (err) throw err;
      var sql = 'UPDATE inwashing SET hours = ?, minutes = ?, seconds = ? WHERE washer_number = 1';
      con.query(sql, [hoursLeft, minutesLeft, secondsLeft] ,function (err, result) 
      {
            if (err) throw err;
            console.log(result.affectedRows + " record(s) updated");
      });
   });

}
//-->
</script>



<script type="text/javascript">
	function washer_1()
	{
		if(document.getElementById('washer_1').style.display == 'inline')
		{
			document.getElementById('washer_1_div').style.display = 'inline-block';
			document.getElementById('washer_1_div').style.marginLeft = '25px';
			document.getElementById('washer_1').style.display = 'none';
		}
	}
	function washer_1_div()
	{
		if(document.getElementById('washer_1_div').style.display == 'inline-block')
		{
			document.getElementById('washer_1_div').style.display = 'none';
			document.getElementById('washer_1_div').style.marginLeft = '-255px';
			document.getElementById('washer_1').style.display = 'inline';
		}
	}

</script>

<html>
<head>
	<title>Laundry: Service Page</title>
	<style>
		body 
      	{
        	margin: 0;
        	font-family: Arial;
        	background-color: BE9BD3;
      	} 
	</style>
</head>
<body>
<div style=" overflow: hidden; background-color: darkviolet; text-align: center; size:100px;">
    <p style="font-size: 30px; color: white;" >Laundry</p>
  </div>
<p style="text-align: center; font-size: 30px; margin-top: 50px; color: darkviolet;"><b>Hello, <?php echo $name; ?></b></p>
<div style="margin-top: 30px;">

<div style="margin-left: 50px; margin-bottom: 10px;">
	<div id='washer_1_color' style="width: 50px; height: 50px; border-radius: 25px; background-color: seagreen; display: inline-block; margin-left: 70px;"></div>
	<div id='washer_2_color' style="width: 50px; height: 50px; border-radius: 25px; background-color: seagreen; display: inline-block; margin-left: 230px;"></div>
	<div id='washer_3_color' style="width: 50px; height: 50px; border-radius: 25px; background-color: seagreen; display: inline-block; margin-left: 230px;"></div>
	<div id='washer_4_color' style="width: 50px; height: 50px; border-radius: 25px; background-color: seagreen; display: inline-block; margin-left: 230px;"></div>
	<div id='washer_5_color' style="width: 50px; height: 50px; border-radius: 25px; background-color: seagreen; display: inline-block; margin-left: 230px;"></div>
</div>
<img id='washer_1' src="washer.svg" style="display: inline; width: 250px; margin-left: 25px;" onclick="washer_1()">
<div id='washer_1_div' style="display: none; width: 250px; background-color: E8E1E9; height: 325px; border-radius: 25px; margin-left: -255px; overflow: hidden;">
<?php
	if($washerin_number1 == 0 AND $washerwait_number1 == 0)
	{
?>
	<script type="text/javascript">
		document.getElementById('washer_1_color').style.backgroundColor = 'seagreen';
	</script>
	<button style="background-color: E8E1E9; width: 250px; height: 400px;" onclick="washer_1_div()"></button>
	<form action="main.php" method="POST">
		<button type="submit" name='washer1_book' style="color: white; font-size: 15px; background-color: blue; width: 150px; height: 30px; margin-top: -270px; margin-left: 50px;" onclick=""><b>Wash</b></button>
		<div>
    		<input name="hour" type="text" id="time" placeholder="Hours" style="width: 100px; margin-top: -230px; margin-left: 80px;" required>
    		<input name="minute" type="text" id="time" placeholder="Minutes" style="width: 100px; margin-top: 0px; margin-left: 80px;" required>
    	</div>
	</form>
<?php
	if(isset($_POST['washer1_book']))
	{	
		$hours = mysqli_real_escape_string($db, $_POST['hour']);
		$minutes = mysqli_real_escape_string($db, $_POST['minute']);

		$user_check_book_code = mysqli_query($db, "SELECT * FROM inwashing WHERE name='$name' LIMIT 1");
		$user_check_book = mysqli_fetch_assoc($user_check_book_code);
		if(isset($user_check_book))
		{
			$message = "max 1 book";
                echo "<script type='text/javascript'>
                alert('$message');
                </script>";
		}
		else
		{
			$book_insert = mysqli_query($db, "INSERT INTO inwashing (washer_number, name, hours, minutes) VALUES('1','$name', '$hours', '$minutes')");
			?>
          <script type="text/javascript">
                window.location = "main.php";
              </script> ;
<?php
		}
	}

	}
	else if($washerin_number1 !== 0)
	{
?>
		<button style="background-color: E8E1E9; width: 250px; height: 400px;" onclick="washer_1_div()"></button>
		<form action="main.php" method="POST">
		<button type="submit" name='washer1_book_wait' style="color: white; font-size: 15px; background-color: blue; width: 150px; height: 30px; margin-top: -270px; margin-left: 50px;" onclick=""><b>Wait</b></button>
		</form>
<?php
		if(isset($_POST['washer1_book_wait']))
		{
			$user_check_book_code = mysqli_query($db, "SELECT * FROM inwashing WHERE name='$name' LIMIT 1");
			$user_check_book = mysqli_fetch_assoc($user_check_book_code);
			
			$user_check_wait_code = mysqli_query($db, "SELECT * FROM waitlist WHERE name='$name' LIMIT 1");
			$user_check_wait = mysqli_fetch_assoc($user_check_wait_code);
			if(isset($user_check_wait))
			{
					$message = "you are in waitlist(max 1 wait)";
                echo "<script type='text/javascript'>
                alert('$message');
                </script>";
			}
			else if(isset($user_check_book))
			{
			$message = "you are washing(max 1 book)";
                echo "<script type='text/javascript'>
                alert('$message');
                </script>";
			}
			else
			{
				$wait_number_code = mysqli_query($db, "SELECT * FROM waitlist WHERE washer_number='1' ORDER BY waitnumber DESC LIMIT 1");
				$wait_number_fetch = mysqli_fetch_assoc($wait_number_code);
				$wait_number = $wait_number_fetch['waitnumber'] + 1;
				$wait_insert = mysqli_query($db, "INSERT INTO waitlist (washer_number, name, waitnumber) VALUES('1','$name', '$wait_number')");
			}
			?>
          <script type="text/javascript">
                window.location = "main.php";
              </script> ;
<?php
		}
		
?>
	<script type="text/javascript">
		document.getElementById('washer_1_color').style.backgroundColor = 'red';
	</script>
<?php
	}
	else
	{
		$to_wash_check_code = mysqli_query($db, "SELECT * FROM waitlist WHERE washer_number='1' ORDER BY waitnumber LIMIT 1");
		$to_wash_check_fetch = mysqli_fetch_assoc($to_wash_check_code);
		$first_inwait = $to_wash_check_fetch['name'];
		if ($name !== $first_inwait) {
			?>
		<button style="background-color: E8E1E9; width: 250px; height: 400px;" onclick="washer_1_div()"></button>
		<form action="main.php" method="POST">
		<button type="submit" name='washer1_book_wait' style="color: white; font-size: 15px; background-color: blue; width: 150px; height: 30px; margin-top: -270px; margin-left: 50px;" onclick="">Wash</button>
		</form>
<?php
if(isset($_POST['washer1_book_wait']))
		{
			$user_check_book_code = mysqli_query($db, "SELECT * FROM inwashing WHERE name='$name' LIMIT 1");
			$user_check_book = mysqli_fetch_assoc($user_check_book_code);
			
			$user_check_wait_code = mysqli_query($db, "SELECT * FROM waitlist WHERE name='$name' LIMIT 1");
			$user_check_wait = mysqli_fetch_assoc($user_check_wait_code);
			if(isset($user_check_wait))
			{
				$wait_number_code = mysqli_query($db, "SELECT * FROM waitlist WHERE washer_number='1' AND name='$name' ORDER BY waitnumber DESC LIMIT 1");
				$wait_number_fetch = mysqli_fetch_assoc($wait_number_code);
				$wait_number_temp = $wait_number_fetch['waitnumber'] - 1;
				$wait_number_code = mysqli_query($db, "SELECT * FROM waitlist WHERE washer_number='1' AND waitnumber='$wait_number_temp'");
				$wait_number_fetch = mysqli_fetch_assoc($wait_number_code);
					$message = $wait_number_fetch['name'];
                echo "<script type='text/javascript'>
                alert('$message is before you');
                </script>";
			}
			else if(isset($user_check_book))
			{
			$message = "you are washing(max 1 book)";
                echo "<script type='text/javascript'>
                alert('$message');
                </script>";
			}
			else
			{
				$wait_number_code = mysqli_query($db, "SELECT * FROM waitlist WHERE washer_number='1' ORDER BY waitnumber DESC LIMIT 1");
				$wait_number_fetch = mysqli_fetch_assoc($wait_number_code);
				$wait_number = $wait_number_fetch['waitnumber'] + 1;
				$wait_insert = mysqli_query($db, "INSERT INTO waitlist (washer_number, name, waitnumber) VALUES('1','$name', '$wait_number')");
				$message = $wait_number_fetch['name'];
                echo "<script type='text/javascript'>
                alert('you are after $message');
                </script>";
			}
			?>
          <script type="text/javascript">
                window.location = "main.php";
              </script> ;
<?php
		}
		}
		else
		{
?>
	<button style="background-color: E8E1E9; width: 250px; height: 400px;" onclick="washer_1_div()"></button>
	<form action="main.php" method="POST">
		<button type="submit" name='washer1_wait_to_book' style="color: white; font-size: 15px; background-color: blue; width: 150px; height: 30px; margin-top: -270px; margin-left: 50px;" onclick="">Wash</button>
		<div>
    		<input name="hour" type="text" id="time" placeholder="Hours" style="width: 100px; margin-top: -210px; margin-left: 80px;" required>
    		<input name="minute" type="text" id="time" placeholder="Minutes" style="width: 100px; margin-top: 0px; margin-left: 80px;" required>
    	</div>
	</form>
<?php
if(isset($_POST['washer1_wait_to_book']))
	{	
		$hours = mysqli_real_escape_string($db, $_POST['hour']);
		$minutes = mysqli_real_escape_string($db, $_POST['minute']);

		
			$book_insert = mysqli_query($db, "INSERT INTO inwashing (washer_number, name, hours, minutes) VALUES('1','$name', '$hours', '$minutes')");
			$delete_wait = mysqli_query($db, "DELETE FROM waitlist WHERE name='$name'")
			?>
          <script type="text/javascript">
                window.location = "main.php";
              </script> ;
<?php
		
	}
	}
?>
	<script type="text/javascript">
		document.getElementById('washer_1_color').style.backgroundColor = 'yellow';
	</script>
<?php
	}
?>
	
</div>
<img id='washer_2' src="washer.svg" style="width: 250px; margin-left: 30px;" onclick="washer_2()">
<div id='washer_2_div' style="display: inline-block; display: none; width: 250px; background-color: black; height: 325px; border-radius: 25px; margin-left: -255px; overflow: hidden;"></div>
<img id='washer_3' src="washer.svg" style="width: 250px; margin-left: 30px;" onclick="washer_3()">
<div id='washer_3_div' style="display: inline-block; display: none; width: 250px; background-color: black; height: 325px; border-radius: 25px; margin-left: -255px; overflow: hidden;"></div>
<img id='washer_4' src="washer.svg" style="width: 250px; margin-left: 30px;" onclick="washer_4()">
<div id='washer_4_div' style="display: inline-block; display: none; width: 250px; background-color: black; height: 325px; border-radius: 25px; margin-left: -255px; overflow: hidden;"></div>
<img id='washer_5' src="washer.svg" style="width: 250px; margin-left: 30px;" onclick="washer_5()">
<div id='washer_5_div' style="display: inline-block; display: none; width: 250px; background-color: black; height: 325px; border-radius: 25px; margin-left: -255px; overflow: hidden;"></div>

<table name="tblTimer" id="tblTimer" width="100px" style="margin-left: 60px;">
<th>Hours</th>
<th>Minutes</th>
<th>Seconds</th>
<tr>
   <td id="cellHours" align="center" style="color: red; font-size: 25px;">-</td>      
   <td id="cellMinutes" align="center" style="color: red; font-size: 25px;">-</td>
   <td id="cellSeconds" align="center" style="color: red; font-size: 25px;">-</td> 

    </tr>
</table>
<div style="align: center; width: 1440px; background-color: gray; text-align: center; height: 100px; margin-top: 60px;">
	<p>---------------------------------------------------</p>
<a href="logout.php" style="font-size: 30px;">LOG OUT</a>
<p>---------------------------------------------------</p>
</div>
</div>
</body>
</html>