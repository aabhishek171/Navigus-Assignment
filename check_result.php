<?php
    include("includes/header.php");
    
    $filterQuery ='';
    
    if(isset($_GET['subject'])){
        $subject = $_GET['subject'];
        $filterQuery.= "WHERE `subject`=$subject";
    }
    
    $query = "SELECT `username`,`score`,time_of_submission`,`subject` FROM `quiz_record`";
    $filterQuery;
    
    $result = mysqli_query($con, $query);
?>

<h3 style="text-align: center;">Quiz Results</h3>
<div class="container" style="margin-top: 20px;">
    <table>
        <thead>
        <th>
            No.
        </th>
        <th>
            Participant
        </th>
        <th>
            Score(%)
        </th>
        <th>
            Subject
        </th>
        <th>
            Time
        </th>
        </thead>
        <tbody>
            <?php
                $count=1;
                while($row = mysqli_fetch_array($result)){ ?>
            <tr>
                <td>
                    <?php echo $count; ?>
                </td>
                <td>
                    <?php echo $row['username']; ?>
                </td>
                <td>
                    <?php echo $row['score']; ?>
                </td>
                <td>
                    <?php echo $row['subject']; ?>
                </td>
                <td>
                    <?php echo $row['time-of_submission']; ?>
                </td>
            </tr>
            <?php
            $count++;
                }
            ?>
        </tbody>
    </table>
</div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>