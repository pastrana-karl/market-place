<?php 
    require_once('constants.php'); 

    $view = $_POST['view'];
    $name = $_POST['name'];
    $comments = $_POST['comments'];

    $query = mysqli_query($conn, "INSERT INTO comment (name, submissionDate, feedback, suggestions) VALUES ('$name',CURDATE(),'$view','$comments');");
    echo '<script>alert("Thank You..! Your Feedback is Valuable to Us"); location.replace(document.referrer);</script>';

?>
