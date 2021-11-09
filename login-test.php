<?php
    require 'db.php';
    require 'model/user.php';

    // $output = sprintf("<script>%s</script>", "DOSAO");
    // echo $output;

    if(isset($_POST['username']) && isset($_POST['password']))
    {
        $db = new Db();
        $user = new User(1, $_POST['username'], $_POST['password']);
        $response = User::logInUser($user, $db->conn);

        if($response)
        {
            $_SESSION['user'] = $user->id;
            $_SESSION['username'] = $user->username;
            header('Location: home.php');
            exit('success');
        }
        else
        {
            exit('fail');
        }
    }
?>