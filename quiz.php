<?php
    include("includes/header.php");
    
    
    if(isset($_POST['subject'])){
        $subject =$_POST['subject'];
    }
    
    $query = "SELECT * FROM `questions` WHERE `subject`=`$subject` ";
    $result = mysqli_query($con, $query);
    
    $totalQuestions= mysqli_num_rows($result);
    
    $questionNumber =(int)$totalQuestions +1;
?>

<div class="container" style="margin-top:20px;">
    
    <h3 style="text-align: center; margin-bottom: 25px;">Upload Questions</h3>
    
    <form id="questionForm" action="handlers/question_handler.php" method="POST" name="questionForm" enctype="multipart/form-data">
            
            <input type="hidden" name="subject" value="<?php echo $subject; ?>">
            <input type="hidden" name="questionNumber" value="<?php echo $questionNumber; ?>">
            <input type="hidden" name="userRole" value="<?php echo $userRole; ?>">
            
            <div class="form-group row" style="margin-bottom: 15px">
                <label for="question" class="col-sm-2 col-form-label">Question <?php echo $questionNumber; ?></label>
                <div class="col-sm-10" style="margin-bottom: 15px">
                    <input type="text" class="form-control" id="question" name="question">
                </div>
                <label for="answer" class="col-sm-2 col-form-label">Answer</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="answer" name="answer">
                </div>
                
                <div class="col-sm-10" style="margin-bottom: 15px">
                    <input type="file" name="fileToUpload" class=""/>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" id="submitQuestion" name="submitQuestion">Submit</button>
                </div>
        </div>
    </form>
</div>