<?php

include "db.php";
include "model/book.php";

session_start();

$db = new Db();

if (isset($_POST['key'])) {
    switch($_POST['key']){
        case 'logout':
            $db->logout();
            break;    
        case 'addNew':
            if(isset($_POST['name']) && isset($_POST['author']) && isset($_POST['year']) && isset($_POST['numberOfPages']) && isset($_POST['selectedValue']))
            {   
                $name = $_POST['name'];
                $author = $_POST['author'];
                $year = intval($_POST['year']);
                $number_pages = intval($_POST['numberOfPages']);
                $user_id = intval($_SESSION['user_id']);
                $category_id = intval($_POST['selectedValue']);

                
                $book = new Book(null, $name, $author, $year, $number_pages, $user_id, $category_id);
                
                $db->insert($book);
            }
            else
            {         
                echo 'Failed to add new book!';
            }
            break;
        case 'getAllBooks':
            $db->getAllBooks();
            break;
    }
}
?>