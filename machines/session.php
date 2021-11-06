<?php
session_start();

$id = $_SESSION['id'];
$db = mysqli_connect('localhost', 'root', '', 'laundry');

$userdata_code = mysqli_query($db, "SELECT * FROM username WHERE id='$id'");
$userdata = mysqli_fetch_assoc($userdata_code);

if(isset($userdata))
	{
		$name = $userdata['first_name'];
		$family = $userdata['second_name'];
		$email = $userdata['email'];
	}

$washerin1_code = mysqli_query($db, "SELECT * FROM inwashing WHERE washer_number='1'");
$washerin1 = mysqli_fetch_assoc($washerin1_code);
if(isset($washerin1))
{
	$washerin_number1 = $washerin1['washer_number'];
	$washerin_name1 = $washerin1['name'];
	$washerin_hours1 = $washerin1['hours'];
	$washerin_minutes1 = $washerin1['minutes'];
	$washerin_seconds1 = $washerin1['seconds'];
}
else
{
	$washerin_number1 = 0;
}

$washerin2_code = mysqli_query($db, "SELECT * FROM inwashing WHERE washer_number='2'");
$washerin2 = mysqli_fetch_assoc($washerin2_code);
if(isset($washerin2))
{
	$washerin_number2 = $washerin2['washer_number'];
	$washerin_name2 = $washerin2['name'];
	$washerin_hours2 = $washerin2['hours'];
	$washerin_minutes2 = $washerin2['minutes'];
}
else
{
	$washerin_number2 = 0;
}


$washerin3_code = mysqli_query($db, "SELECT * FROM inwashing WHERE washer_number='3'");
$washerin3 = mysqli_fetch_assoc($washerin3_code);
if(isset($washerin3))
{
	$washerin_number3 = $washerin3['washer_number'];
	$washerin_name3 = $washerin3['name'];
	$washerin_hours3 = $washerin3['hours'];
	$washerin_minutes3 = $washerin3['minutes'];
}
else
{
	$washerin_number3 = null;
}


$washerin4_code = mysqli_query($db, "SELECT * FROM inwashing WHERE washer_number='4'");
$washerin4 = mysqli_fetch_assoc($washerin4_code);
if(isset($washerin4))
{
	$washerin_number4 = $washerin4['washer_number'];
	$washerin_name4 = $washerin4['name'];
	$washerin_hours4 = $washerin4['hours'];
	$washerin_minutes4 = $washerin4['minutes'];
}
else
{
	$washerin_number4 = null;
}


$washerin5_code = mysqli_query($db, "SELECT * FROM inwashing WHERE washer_number='5'");
$washerin5 = mysqli_fetch_assoc($washerin5_code);
if(isset($washerin5))
{
	$washerin_number5 = $washerin5['washer_number'];
	$washerin_name5 = $washerin5['name'];
	$washerin_hours5 = $washerin5['hours'];
	$washerin_minutes5 = $washerin5['minutes'];
}
else
{
	$washerin_number5 = null;
}

$waitlist1_code = mysqli_query($db, "SELECT * FROM waitlist WHERE washer_number='1'");
$waitlist1 = mysqli_fetch_assoc($waitlist1_code);
if(isset($waitlist1))
{
	$washerwait_number1 = $waitlist1['washer_number'];
	$washewait_name1 = $waitlist1['name'];
	$washerwait_waitnumber1 = $waitlist1['waitnumber'];
}
else
{
	$washerwait_number1 = 0;
}


$waitlist2_code = mysqli_query($db, "SELECT * FROM waitlist WHERE washer_number='2'");
$waitlist2 = mysqli_fetch_assoc($waitlist2_code);
if(isset($waitlist2))
{
	$washerwait_number2 = $waitlist2['washer_number'];
	$washewait_name2 = $waitlist2['name'];
	$washerwait_waitnumber2 = $waitlist2['waitnumber'];
}
else
{
	$washerwait_number2 = null;
}



$waitlist3_code = mysqli_query($db, "SELECT * FROM waitlist WHERE washer_number='3'");
$waitlist3 = mysqli_fetch_assoc($waitlist3_code);
if(isset($waitlist3))
{
	$washerwait_number3 = $waitlist3['washer_number'];
	$washewait_name3 = $waitlist3['name'];
	$washerwait_waitnumber3 = $waitlist3['waitnumber'];
}
else
{
	$washerwait_number3 = null;
}


$waitlist4_code = mysqli_query($db, "SELECT * FROM waitlist WHERE washer_number='4'");
$waitlist4 = mysqli_fetch_assoc($waitlist4_code);
if(isset($waitlist4))
{
	$washerwait_number4 = $waitlist4['washer_number'];
	$washewait_name4 = $waitlist4['name'];
	$washerwait_waitnumber4 = $waitlist4['waitnumber'];
}
else
{
	$washerwait_number4 = null;
}


$waitlist5_code = mysqli_query($db, "SELECT * FROM waitlist WHERE washer_number='5'");
$waitlist5 = mysqli_fetch_assoc($waitlist1_code);
if(isset($waitlist5))
{
	$washerwait_number5 = $waitlist5['washer_number'];
	$washewait_name5 = $waitlist5['name'];
	$washerwait_waitnumber5 = $waitlist5['waitnumber'];
}
else
{
	$washerwait_number5 = null;
}


$washer1_timer_code = mysqli_query($db, "SELECT * FROM inwashing WHERE washer_number='1'");
$washer1_timer = mysqli_fetch_assoc($washer1_timer_code);
if(isset($washer1_timer))
{
	$hours_data = $washer1_timer['hours'];
	$minutes_data = $washer1_timer['minutes'];
}



?>