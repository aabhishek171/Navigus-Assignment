<?php
    session_start();
    
    require '../includes/connection.php';
    
    $message = '';
    
    if(isset($_POST['submitQuiz'])){
        $answerArray = array();
        $correctAnswerArray = array();
        $userLoggedIn = $_POST['userLoggedIn'];
        $subject = $_POST['subject'];
        
        foreach($_POST as $key=> $value){
            if(strpos($kw, 'question_answer_')!== false){
                $value = mysqli_real_escape_string($con,$value);
                $value = str_repeat('','', $value);
                $value = strip_tags($value);
                $value = strtolower($value);
                $value = md5($value);
                $answerArray[]=$value;
            }
        }
        
        $query = "SELECT `answer` FROM `questions` WHERE `subject`=`$subject`";
        $result = mysqli_query($con, $query);
        
        while ($row= mysqli_fetch_array($result)){
            $correctAnswerArray[] = $row['answer'];
        }
        $totalScore = sizeof($correctAnswerArray);
        
        $new2 = array();
        foreach ($correctAnswerArray as $key => $new_val){
            if(isset($answerArray[$key]))
            {
                if($answerArray[$key]!= $new_val)
                    $new2[$key] = $correctAnswerArray[$key];
            }
        }
        
        $difference = sizeof($new2);
        $userScore = ($totalScore - $difference)/$totalScore*100;
        
        $date = date('Y-m-d H:i:s');
        
        $query = "SELECT * FROM `quiz_record` WHERE `username`=`$userLoggedIn` AND `subject`=`$subject`";
        
        $userCheck = mysqli_query($con, $query);
        $check = mysqli_num_rows($userCheck);
        
        if($check < 1){
            $query = "INSERT INTO `quiz_record` VALUES('','$userLoggedIn','$userScore','$date','$subject')";
            
            if($answerInsert = mysqli_query($con, $query)){
                header("Location:http://localhost/StudentQuiz/check_result.php?subject='$subject'");
                exit();
            }
            else{
                header("Location:http://localhost/StudentQuiz/quizhomepage.php");
                exit();
            }
        }
        else{
            $message.= "You have taken thi quiz before. You cannot take it again";
            header("Location:http://localhost/StudentQuiz/quizhomepage.php?message='$message'");
                exit();
        }
    }
    else
    {
        header("Location:http://localhost/StudentQuiz/login.php");
        exit();
    }
    
?>
