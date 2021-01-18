<?php
session_start();
include 'includes/config.php';
$id = $_GET['id'];
mysqli_query($db, "delete from exams where id = '$id' ");
?>

<script type="text/javascript">
    window.location.href = "classes.php?classid=<?php echo $_SESSION['classid']; ?>";
</script>