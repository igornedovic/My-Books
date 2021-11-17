<?php

require_once "db.php";
include "model/user.php";
include "model/book.php";

session_start();

$db = new Db();

if (isset($_POST['key'])) {
    switch($_POST['key']){
        case 'login':
            if(isset($_POST['username']) && isset($_POST['password'])){
                $username = $_POST['username'];
                $password = $_POST['password'];
        
                $db = new Db();
                $user = new User(null, $username, $password);
        
                $db->login($user);
            }
            break;
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
        case 'getBookById':
            if(isset($_POST['bookId']))
            {
                $id = $_POST['bookId'];
                $db->getBookById($id);
            }
            else
            {         
                echo 'Failed to load book data!';
            }
            break;
        case 'update':
            if(isset($_POST['bookId']) && isset($_POST['name']) && isset($_POST['author']) && isset($_POST['year']) && isset($_POST['numberOfPages']) && isset($_POST['selectedValue']))
            {   
                $id = $_POST['bookId'];
                $name = $_POST['name'];
                $author = $_POST['author'];
                $year = intval($_POST['year']);
                $number_pages = intval($_POST['numberOfPages']);
                $user_id = intval($_SESSION['user_id']);
                $category_id = intval($_POST['selectedValue']);

                $book = new Book(null, $name, $author, $year, $number_pages, $user_id, $category_id);

                $db->update($id, $book);
            }
            break;
        case 'deleteBook':
            if(isset($_POST['bookId']))
            {
                $id = $_POST['bookId'];

                $db->delete($id);
            }
            break;
    }
}
?>