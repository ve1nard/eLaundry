<?php
session_start();
?>
<html>
<head>
  <title>AUS</title>

  <style>
    body 
      {
        font-family: Arial;
        margin: 0;
        background-color: BE9BD3;
      }

    .tab 
      {
        overflow: visible;
        border: 0px solid #ccc;
      }

    .tab button 
      {
        margin-left: auto;
        margin-right: auto;
        background-color: inherit;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 20px;
      }

    .tab button:hover 
      {
        background-color: #ddd;
      }

    .tab button.active 
      {
        background-color: #ccc;
      }

    .tabcontent 
      {
        text-align: center;
        padding: 6px 12px;
        border: 0px solid #ccc;
        border-top: none;
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

    .input
      {
        border-radius: 10px;
        border: 1px;
        padding: 20px;
        width: 500px;
        height: 15px;
        font-size: 18px;
      }

    .signup_button
      {
        border-radius: 5px;
        font-size: 20px;
        width: 200px;
        height: 35px;
        background-color: green;
        border: 1px;
      }
  </style>
</head>

<body>

  <div class="topnav" >
    <p class="aus" >Laundry</p>
  </div>

  <div class="" style="text-align: center; ">
    <br>
    <form action="reg.php" method="POST">
      <div id="Username" class="tabcontent"> <br>

        <div>
          <input name="fname" type="text" id="fname" class="input"  placeholder="Firstname" required autofocus>
        </div> <br>

        <div>
          <input name="lname" type="text" id="lname" class="input" placeholder="Lastname" required>
        </div> <br>
      
        <div>
          <input name="email" type="mail" id="email" class="input" placeholder="Email" required>
        </div> <br>

        <div>
          <input name="password_1" type="password" id="password" class="input" placeholder="Password" required>
        </div> <br>

        <div>
          <input name="password_2" type="password" id="password" class="input" placeholder="Confirm your password" required>
        </div>  <br><p></p><br><br><br><br>

        <button type="submit" class="signup_button" name='reg_user'><b>Sign up</b></button>
        <p></p>
        <div style="font-size: 19px; ">
          Already a member?<a href='signin.php' style="color: white;">log in</a>
        </div>
 
      </div>
    </form>
<?php
    $errors=null;
    $db = mysqli_connect('localhost', 'root', '', 'laundry'); // connecting to the aus database
    if (isset($_POST['reg_user'])) 
      {
        $user_fname = mysqli_real_escape_string($db, $_POST['fname']); // entered text is stored into variable
        $user_lname = mysqli_real_escape_string($db, $_POST['lname']); // entered text is stored into variable
        $user_email = mysqli_real_escape_string($db, $_POST['email']); // entered text is stored into variable
        $user_password_1 = mysqli_real_escape_string($db, $_POST['password_1']); // entered text is stored into variable
        $user_password_2 = mysqli_real_escape_string($db, $_POST['password_2']); // entered text is stored into variable
        $user_password_sha1 = SHA1($user_password_1); // 
        // checking whether fields are filled or not
        if (empty($user_fname)) 
          { 
            $message = "Firstname is required";
            echo "<script type='text/javascript'>alert('$message');</script>"; // displaying message 
            $errors=1; 
          }
        if (empty($user_lname)) 
          { 
            $message = "Lastname is required";
            echo "<script type='text/javascript'>alert('$message');</script>"; // displaying message 
            $errors=1;  
          }
        if (empty($user_email)) 
          { 
            $message = "Email is required";
            echo "<script type='text/javascript'>alert('$message');</script>"; // displaying message 
            $errors=1;
          }
        if (empty($user_password_1)) 
          { 
            $message = "Password is required";
            echo "<script type='text/javascript'>alert('$message');</script>"; // displaying message 
            $errors=1; 
          }
        if ($user_password_1 != $user_password_2) 
          {
            $message = "The two passwords do not match";
            echo "<script type='text/javascript'>alert('$message');</script>"; // displaying message 
            $errors=1;
          }
  
        $user_check_code= "SELECT * FROM username WHERE email='$user_email' LIMIT 1";
        $user_check = mysqli_query($db, $user_check_code); // selecting information from customer table according email entered by new user
        $user_result = mysqli_fetch_assoc($user_check);

          // if the email already exists
        if(isset($user_result)) 
          { 
            if ($user_result['email'] == $user_email) 
              {
                $message = "email already exists";
                echo "<script type='text/javascript'>
                alert('$message');
                </script>";
                $errors=1;
              }
          }
        // if entered new email does not exist and all information is correct
        else if ($errors == 0) 
          {    
            // inserting new username into table customer with details
            $user_insert = mysqli_query($db, "INSERT INTO username (first_name, second_name, email, password_sha1) VALUES('$user_fname','$user_lname', '$user_email', '$user_password_sha1')");
?>
            <script type="text/javascript">
              alert("Registered"); /* displaying message showing that the registration is complete */ 
              window.location = "signin.php";
            </script>;
<?php
          }
        if($errors == 1)
        {
?>
          <script type="text/javascript">
                window.location = "reg.php";
              </script> ;
<?php
        }
        }
?>

  </div>
</body>
</html>