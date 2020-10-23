<?php
    include("includes/header.php");
    
    if($userRole > 1){
        header("Location:http://localhost/StudentQuiz/quizhomepage.php");
        exit();
    }
    
    if(isset($_GET['message'])){
        $message = $_GET['message'];
    }
    
    $subjectOptions = array(
        "C" => "C",
        "C++" => "C++",
        "Java" => "java",
        "DBMS" => "DBMS",
        "HTML" => "HTML",
        "CSS" => "CSS",
        "Data Structure" => "Data Structure",
        "NodeJs" => "NodeJs"
    );
?>

    <div class="container" style="margin-top:20px;">
        <div style="text-align: center; font-weight: bold;">
            <p><?php if(isset($message)){ $message;} ?></p>
        </div>
        <form id="deleteForm" action="delete_handler.php" method="POST" name="deleteSubjectForm">
            <input type="hidden" name="userLoggedIn" value="<?php echo $userLoggedIn; ?>">
            <input type="hidden" name="userRole" value="<?php echo $userRole; ?>">
            
            <div class="form-group row">
                <label for="subjects" class="col-sm-2 col-form-label">Choose Subject to delete</label>
                <div class="col-sm-10">
                    <select type="select" class="form-control" id="subject" name="subjects[]">
                        <?php 
                        foreach($subjectOptions as $key => $value)
                            {
                                ?>
                                <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" id="submitDeleteSubject" name="submitDeleteSubject">Proceed</button>
                </div>
            </div>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>