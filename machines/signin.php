<?php
session_start();
?>
<html lang="en">
<link rel='stylesheet' type='text/css' >
<head>
  <title>Login</title>        
  <style type="text/css">
    body 
      {
        margin: 0;
        font-family: Arial;
        background-color: BE9BD3;
      } 

    div
      {
        text-align: center;
      }

    .message_error
      {
        text-align: center;
        padding: 15px;
        margin-left: 709px;
        margin-right: 837px;
        margin-top: -295px;
        color: #A52A2A;
        margin-bottom: 30px;
        border: 2px solid #FFEBCD;
        border-radius: 7px;
        background-color: #FFEBCD;
        width: 466px;
        height: 15px;
      }

    .message_successful
      {
        text-align: center;
        padding: 15px;
        margin-left: 708px;
        margin-right: 837px;
        margin-top: -300px;
        color: #3CB371;
        margin-bottom: 30px;
        border: 2px solid #98FB98;
        border-radius: 7px;
        background-color: #98FB98;
        width: 469px;
        height: 15px;
      }

    .topnav 
      {
        overflow: hidden;
        background-color: darkviolet;
        text-align: center;
        size:100px;
      }

    .aus
      {
        font-size: 30px;
        color: white;
      }

    .email_input
      {
        border-radius: 10px;
        padding: 20px;
        width: 500px;
        height: 15px;
        font-size: 19px;
        margin-top: 20px;
        border: 1px;
      }

    .password_input
      {
        border-radius: 10px;
        border: 1px;
        padding: 20px;
        width: 500px;
        height: 15px;
        font-size: 19px;
        margin-top: 00px;
      }

    .signin_button
      {
        border-radius: 5px;
        background-color: green;
        font-size: 20px;
        width: 200px;
        height: 35px;
        border: 1px;
      }

  </style>
</head>

<body>
  <div class="topnav" >
    <p class="aus" >Laundry</p>
  </div>
  <br>
  <div class="">
    <form class="" action="signin.php" method="POST">
        <h1 class="">
            Please sign in
        </h1>
        <br>

        <div>
          <input name="email" id="email" class="email_input" placeholder="Email" required autofocus>
        </div>
        <br>
        
        <div>
          <input name="password" type="password" id="password" class="password_input" placeholder="Password" required>
        </div>

        <input type="hidden" name="login" value="true">
        <br>
        <p></p><br>
        <button class="signin_button" name="sign" type="submit" onclick="error()"><b>Login</b></button>

         <br><br>
        <div style="font-size: 17px;">
          Don't have an account?
          <a href='reg.php' style="font-size: 17px; color: white;">sign up<a>
        </div>
    </form>
  </div> 

</body>
</html>


<?php
  $successful=0;
  $sql=null;
  $sq=null;
  $errors=null;
  $db = mysqli_connect('localhost', 'root', '', 'laundry'); // connecting to the aus database
  
  // if the button signin is clicked
  if (isset($_POST['sign'])) 
    {
      $email = mysqli_real_escape_string($db,$_POST['email']);
      $password = mysqli_real_escape_string($db,$_POST['password']);
      $password_sha1 = SHA1($password);

      // if the variables are empty error will occur
      if (empty($email)) 
        { 
          $errors=1; 
        }
        if (empty($password_sha1)) 
        { 
          $errors=1;  
        }
     // selecting the information from 3 different databases according to the details entered
      $select_username=mysqli_query($db,"SELECT * FROM username WHERE email='$email' AND password_sha1='$password_sha1'");

      // if there is actual information from 1 database
      if(isset($select_username))
        {

          $count_username = mysqli_num_rows($select_username);
          $row_username = mysqli_fetch_array($select_username);

          if($count_username == 1) // if there is only one user with this username
            {
              $successful=1;
              $_SESSION['id'] = $row_username['id']; // storing customer id to the session variable
?>
              <p class="message_successful">Login successful</p>
              <script type="text/javascript">
                window.location = "main.php";
              </script> ;
<?php
            }
        }

        if($successful==0)
          {
                $_SESSION['id']=null;
?>
                <p class="message_error">Login or Password is invalid</p> 
<?php
              
          }
        
      }
?>