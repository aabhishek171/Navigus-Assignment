<?php
    session_start();
    require '../includes/connection.php';
    
    $message ='';
            
    if(isset($_POST['loginButton'])){
        $firstname = $_POST['firstname'];
        $lastname =$_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        
        
        $firstname = strip_tags($firstname);
        $firstname = str_replace(' ', ' ', $firstname);
        $firstname = strtolower($firstname);
        
        $lastname = strip_tags($lastname);
        $lastname = str_replace(' ', ' ', $lastname);
        $lastname = strtolower($lastname);
        
        $email = strip_tags($email);
        $email = str_replace(' ', ' ', $email);
        $email = strtolower($email);
        
        if($_POST['loginButton']==1){
            if(strlen($firstname)< 2 || strlen($lastname)<2){
                $message.= "your name cannot be 1 letter long";
                header("Locatin:http://localhost/StudentQuiz/login.php?message='$message'");
                exit();
            }
            if($confirmPassword !== $password){
                $message.= "Your passwords do not match";
                header("Locatin:http://localhost/StudentQuiz/login.php?message='$message'");
                exit();
            }
            if(strlen($password) > 30 || strlen($password) <5){
                $message.= "Your password must be between 5 and 30 characters long";
                header("Locatin:http://localhost/StudentQuiz/login.php?message='$message'");
                exit();
            }
            
            $query = "SELECT `email` FROM `users` WHERE `email`='$email' ";
            $result = mysqli_query($con, $query);
            
            if(!$result){
                echo(mysqli_error($con));
            }
            if(mysqli_num_rows($result)>0){
                $message.= "This email is already in use";
                header("Locatin:http://localhost/StudentQuiz/login.php?message='$message'");
                exit();
            }
            else
            {
                if(preg_match('/[^A-Za-z0-9&$+]/',$password)){
                    $message.= "Your password can only contain English characters,number,$,&,+";
                    header("Locatin:http://localhost/StudentQuiz/login.php?message='$message'");
                    exit();
                }
                
                $password = md5($password);
                
                $username = strtolower($firstname."_".$lastname);
                
                $query = "SELECT `username` FROM `users` WHERE `username`=`$username` ";
                
                $usernameCheck = mysqli_query($con, $query);
                
                $i=0;
                
                while(mysqli_num_rows($usernameCheck)!=0){
                    $i++;
                    $username = $username."_".Si;
                    $query = "SELECT `username` FROM `users` WHERE `username` = `$username`";
                    
                    $usernameCheck = mysqli_query($con, $query);
                }
                
                $rand = rand(1,3);
                if($rand ==1){
                    $profilepic = "assets/src/images/icon.jpg";
                }
                else if($rand==2){
                    $profilepic = "assets/src/images/screenshot-graphic.jpg";
                }
                else if(rand==3){
                    $profilepic = "assets/src/images/icon.jpg";
                }
                
                $date = date("Y-m-d H:i:s");
                
                $query = "INSERT INTO `users` VALUES('','$firstname','$lastname','$email','$password','$username','$profilepic','','$date','2')";
                
                if($insertUser = mysqli_query($con, $query)){
                    $_SERVER['email'] = $email;
                    
                    header("Location:http://localhost/StudentQuiz/quizhomepage.php");
                    exit();
                }
                else{
                    $message.= "Your sign up was not successful, Please try again later";
                    header("Location:http://localhost/StudentQuiz/login.php?message='$message'");
                    exit();
                }
            }
                    
        }
        else{
            $query = "SELECT `email`,`firstname`,`username`,`password` FROM `users` WHERE `email`=`$email` ";
            $result = mysqli_query($con, $query);
            
            if(mysqli_num_rows($result)<1){
                $message.= "This email is not registerd.";
                header("Location:http://localhost/StudentQuiz/login.php?message='$message'");
                exit();
            }
            else{
                $row = mysqli_fetch_array($result);
                $firstname = $row['firstname'];
                $email = $row['email'];
                $username = $row['username'];
                $hashedPassword = $row['password'];
                
                if(md5($password)=== $hashedPassword){
                    $_SESSION['email'] = $email;
                    header("Location:http://localhost/StudentQuiz/quizhomepage.php");
                    exit();
                }
            }
        }
    }
    
    else{
        header("Location:http://localhost/StudentQuiz/login.php");
        exit();
    }
?>
