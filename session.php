<?php
    include 'db.php';
    include 'model/user.php';

    session_start();

    // if(isset($_SESSION['loggedIn'])){
    //     exit('loggedIn');
    // }

    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $operations = new Db();
        $user = new User(null, $username, $password);

        $operations->login($user);
    }

?>