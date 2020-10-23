<?php 
    include("includes/header.php");
    
    if(isset($_GET['message'])){
        $message = $_GET['message'];
    }
    
    $subjectOptions = array();
    
    $query = "SELECT DISTINCT `subject` FROM `questions` ";
    $result = mysqli_query($con, $query);
    while($row= mysqli_fetch_array($result)){
        $subjectOptions[] =$row['subject'];
    }
    
    $totalQuestions = mysqli_num_rows($result);
    $questionNumber = (int)$totalQuestions+1;
    
?>
      <div class="container" style="margin-top:20px;">
          <h3 style="text-align: center; margin-bottom: 25px;">Test Your knowledge</h3>
          <div style="text-align: center; font-weight: bold;">
              <p><?php if(isset($message)){ echo $message; } ?></p>
          </div>
          <form id="quizForm" action="questions.php" method="POST" name="quizForm">
            
            <input type="hidden" name="userLoggedIn" value="<?php echo $userLoggedIn; ?>">
            
            <div class="form-group row">
                <label for="subjects" class="col-sm-2 col-form-label">Choose Subject</label>
                <div class="col-sm-10">
                    <select type="select" class="form-control" id="subject" name="subject">
                        <?php 
                            for($i=0; $i<count($subjectOptions); $i++)
                            {
                                ?>
                                <option value="<?php echo $subjectOptions[$i]; ?>"><?php echo $subjectOptions[$i]; ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" id="submitButton" name="submitButton">Proceed</button>
                </div>
            </div>
        </form>
      </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>