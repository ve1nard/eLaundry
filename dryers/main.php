<?php
session_start();
?>
<html>
<head>
    <link rel="stylesheet" href="main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="main.js"></script>
</head>
<body>
  <div style="size:100px; background-color:darkviolet;overflow:hidden;text-align:center;"></div>
<div class="baskets" style="margin-top:200px;">
  <div class="basket">
    
    <form action="main.php" class="basket1" method="POST">
      <div style="display: flex;
  flex-direction: column;
  justify-content: center;"><img id="basket1" src="images/empty-basket.svg">
    <input type="text" id="fname" name="fname" value="1" readonly size="1" style="margin-top:5px; text-align:center;"><br><br></div>
    
      <label for="washing_machines">Choose a washing machine:</label>
      <select name="washing_machines" id="washing-machines">
        <option value="1">Machine 1</option>
        <option value="2">Machine 2</option>
        <option value="3">Machine 3</option>
        <option value="4">Machine 4</option>
        <option value="5">Machine 5</option>
      </select>
      <input type="submit" value="Send clothes to the basket"> 
      
      <button type="button" class="btn btn-light" data-name="register" onclick="clean('basket1')">Clean the basket!</button>
      <input type="text" id="machine_name" name="fname" value="1" readonly size="15" style="margin-top:5px; text-align:center;">
    </form>
    <?php  
    $conn = mysqli_connect('localhost', 'root', '', 'laundry'); 
    $sql1 = "SELECT id, occupied from dryers WHERE id = '1';";
    $occupied = mysqli_query($conn,$sql1);
    $row = mysqli_fetch_assoc($occupied);


    
    if (isset($_POST['washing_machines'])){
      $basket=$_POST['fname'];
    $washing_machine=$_POST['washing_machines'];  
    $sql2 = "INSERT INTO dryers (id, id_machine, occupied) VALUES ('$basket','$washing_machine','1')";
    if ($row['occupied']=='1'){ echo "<script>document.getElementById('basket1').src = 'images/full-basket.svg';</script>";
      echo " <script>document.getElementById('machine_name').value='Machine $washing_machine clothes';</script>";}
      if ($row['occupied']=='0'){ echo "<script>document.getElementById('basket1').src = 'images/empty-basket.svg';</script>";}
    if ($conn->query($sql2) === TRUE) 
 {  
  

 } else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
 }
    }

    
?>

  </div>
  <div class="basket">
    <form action="main.php" id="machine1" method="POST">
    <div style="display: flex;
  flex-direction: column;
  justify-content: center;"><img id="basket1" src="images/empty-basket.svg">
    <input type="text" id="fname" name="fname" value="2" readonly size="1" style="margin-top:5px; text-align:center;"><br><br></div>
      <label for="washing-machines">Choose a washing machine:</label>
      <select name="washing-machines" id="washing-machines">
        <option value="1">Machine 1</option>
        <option value="2">Machine 2</option>
        <option value="3">Machine 3</option>
        <option value="4">Machine 4</option>
        <option value="5">Machine 5</option>
      </select>
      <input type="submit" value="Send clothes to the basket"> 
      
      <button type="button" class="btn btn-light" data-name="register" onclick="clean('basket1')">Clean the basket!</button>
      <input type="text" id="machine_name" name="fname" value="1" readonly size="15" style="margin-top:5px; text-align:center;">
    </form>
  </div>
  <div class="basket">
    
    <form action="main.php" id="machine1" method="POST">
    <div style="display: flex;
  flex-direction: column;
  justify-content: center;"><img id="basket3" src="images/empty-basket.svg">
    <input type="text" id="fname" name="fname" value="3" readonly size="1" style="margin-top:5px; margin-bottom:38px;text-align:center;"></div>
      <label for="washing-machines">Choose a washing machine:</label>
      <select name="washing-machines" id="washing-machines">
        <option value="1">Machine 1</option>
        <option value="2">Machine 2</option>
        <option value="3">Machine 3</option>
        <option value="4">Machine 4</option>
        <option value="5">Machine 5</option>
      </select>
      <input type="submit" value="Send clothes to the basket"> 
      
      <button type="button" class="btn btn-light" data-name="register" onclick="clean('basket1')">Clean the basket!</button>
      <input type="text" id="machine_name" name="fname" value="1" readonly size="15" style="margin-top:5px; text-align:center;">
    </form>
  </div>
</div>

</body>
</html>