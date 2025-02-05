<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
       $name="";
       $email="";
       $website="";
       $comment="";
       $gender="";

       $nameError="";
       $emailError ="";
       $websiteError ="";
       $commentError="";
       $nameError="";
       $genderError="";

       if($_SERVER["REQUEST_METHOD"]== "POST"){
            $name=$_REQUEST['name'];
            $email=$_REQUEST['email'];
            $website=$_REQUEST['website'];
            $comment=$_REQUEST['comment'];
            $gender=$_REQUEST['gender'];

            if(empty($name)){
                $nameError="*Name is Required";
            }else{
                $name=$_REQUEST['name'];
                if(!preg_match("/^[a-zA-Z-' ]*$/",$name)){
                     $nameError="*Only letters and white space allowed";
                }
            }
            if(empty($email)){
                $emailError="*Email is required";
            }else{
                $email=$_REQUEST['email'];
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $emailErr = "*Invalid email format";
                }
            }
            if(empty($website)){
                $website="";
            }else{
                $website=$_REQUEST['website'];
                  if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)){
                    $websiteError="*Invalid URL";
                  }
            }

            if(empty($comment)){
                $comment="";
            }else{
                $comment=$_REQUEST['comment'];
            }

            if(empty($gender)){
                $genderError="*gender is Required";
            }else{
                $gender=$_REQUEST['gender'];
                
            }
            
       }
       
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    Name:<input type="text" name="name" value="<?php echo $name  ?>">
         <span class="error"><?php echo $nameError    ?></span>
         <br>
    Email:<input type="email" name="email" value="<?php echo $email?>">
         <span class="error"><?php echo $emailError    ?></span>
         <br> 
    Website:<input type="text" name="website" value="<?php echo $website?>">
         <span class="error"><?php echo $websiteError    ?></span>
         <br>
    Comment:<textarea name="comment" rows="5" cols="40" value=""><?php echo $comment?> </textarea>
         <span class="error"><?php echo $commentError ?></span>
         <br>
    select gender:
        <input type="radio" name="gender" value="male" <?php if(isset($gender) && $gender==="male") echo "checked";?>>male
        <input type="radio" name="gender"  value="female" <?php if(isset($gender) && $gender==="female") echo "checked";?>>female
        <input type="radio" name="gender"  value="others" <?php if(isset($gender) && $gender==="others") echo "checked";?>>others
        <span class="error"><?php echo $genderError ?></span>
        <br>
        <input type="submit">
    </form>
    <?php
     echo "<h2>Your Input:</h2>";
     echo $name;
     echo "<br>";
     echo $email;
     echo "<br>";
     echo $website;
     echo "<br>";
    echo $comment;
    echo "<br>";
    echo $gender;
   

    ?>
</body>
</html>