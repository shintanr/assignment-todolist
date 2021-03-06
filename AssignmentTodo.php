
<?php
include 'DatabaseTodo.php';
?>

<?php
if (isset($_POST['add_post'])){
    $task_name = mysqli_real_escape_string($connection, $_POST['task_name']);
    $query = mysqli_query($connection, "INSERT INTO tasks (task_name, task_status, task_date) VALUES ('$task_name', 'pending', now())");

    header("Location: AssignmentTodo.php");
}

if(isset($_GET['edit'])){
    $task_id = $_GET['edit'];
    $query = mysqli_query($connection, "UPDATE tasks SET task_status = 'selesai' WHERE task_id = '$task_id'");
    header("Location: AssignmentTodo.php");
}


if(isset($_GET['delete'])){
    $task_id = $_GET['delete'];
    $query = mysqli_query($connection, "DELETE FROM tasks WHERE task_id = '$task_id'");
    header("Location: AssignmentTodo.php");
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASSIGNMENT TODOLIST</title>
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#"> <i class="bi bi-bag-fill"></i>TO-DO</a>
        </div>
    </nav>
    <!-- Akhir Navbar -->

    <!-- jumbotron -->
    <div class="jumbotron bg-light">
    <h1 class="display-2 text-center " padding="5rem" >ASSIGNMENT TODOLIST</h1>
    </div>
    <!-- akhir jumbotron -->


    <body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center"></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <h3>Ada tugas apa nih?</h3>
                        <form method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="task_name" placeholder="masukkan tugas">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="add_post" class="btn btn-secondary btn-block">Tambah Tugas</button>
                        </div>
                        </form>
                        <h3>Antrean tugas </h3>
                        <ul class="list-group">
                            <?php
                            $query = mysqli_query($connection, "SELECT * FROM tasks WHERE task_status = 'pending' ");
                            while($row = mysqli_fetch_array($query)){
                                $task_id = $row['task_id'];
                                $task_name = $row['task_name'];
                                
                            ?>
                            <li class="list-group-item">
                                <?php echo $task_name; ?>
                                <div class="float-right">
                                    <a href="AssignmentTodo.php?edit= <?php echo $task_id ?>" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="done todo">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                </svg>
                                </a>    
                                <a href="AssignmentTodo.php?delete= <?php echo $task_id ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="remove todo">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg> 
                                    </a>
                                </div>
                            </li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <h3>Yey, selesai!</h3>
                        <ul class="list-group">
                            <?php 
                            $query = mysqli_query($connection, "SELECT * FROM tasks WHERE task_status = 'selesai' ");
                            while($row = mysqli_fetch_array($query)){
                            ?>

                            <li class="list-group-item">
                            <?php echo $row['task_name']?>

                            <div class="float-right">
                                    <span class="badge badge-warning" <?php echo $row['task_status'] ?>>selesai</span>
                            </div>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script>$(function () {
    $('[data-toggle="tooltip"]').tooltip()
    })</script>
</body>
<!-- Akhir body -->
    
<!-- Footer -->
    <footer class="bg-dark text-white text-center pb-5">
        <p>Created with <3 <i class="bi bi-heart-fill"></i> by
            <a href="https://github.com/shintanr/TA_DKP_SHINTA-NURROHMAH_21120121140093_ASSIGNMENT-TODOLIST" class="text-white fw-bold" target="_blank"><u>Shinta Nurrohmah</u></a>
        </p>
    </footer>
<!-- Akhir Footer -->
   

</html>