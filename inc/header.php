<?php
    include "db.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Books</title>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-light bg-white border-bottom box-shadow mb-3">
            <div class="container">
                <a class="navbar-brand" href="#">MyBooks</a>
                <?php if(isset($_SESSION['user_id'])):?>
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link text-dark" id="book-list" href="bookList.php">Book List</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <?php if(isset($_SESSION['username'])):?>
                        <li class="nav-item">                               
                            <a id="manage" class="nav-link text-dark">Hello <?php echo $_SESSION['username']?>!</a> 
                        </li>
                        <?php endif;?>
                        <li class="nav-item">
                            <button id="btn-logout" type="button" class="nav-link btn btn-link text-dark">Logout</button>
                        </li>
                    </ul>   
                <?php endif;?>                
            </div>
        </nav>
    </header>