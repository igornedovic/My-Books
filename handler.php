<?php
// $output = sprintf("<script>%s</script>", "DOSAO");
// echo $output;

include "db.php";

session_start();

$db = new Db();

if (isset($_POST['key'])) {
    switch($_POST['key']){
        case 'logout':
            $db->logout();
            break;    
    }
}
?>