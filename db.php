<?php

require_once "model/dataToReturn.php";

class Db {
    public $conn;

    function __construct()
    {
        $this->conn = new mysqli('localhost', 'root', '', 'mybooks');

        if ($this->conn->connect_errno) {
            exit("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Login
    public function login(User $user)
    {
        $username = $this->conn->real_escape_string($user->username);
        $password = $this->conn->real_escape_string($user->password);

        $data = $this->conn -> query("SELECT * FROM users WHERE username='$username' AND password='$password'");

        if($data->num_rows == 0)
        {
            $query = $this->conn -> query("INSERT INTO users (username, password) VALUES('$username', '$password')");

            if($query)
            {
                $this->setUser($username, $password);
                exit('success');
            }
            else
            {
                exit('Failed to login!');
            }
        }
        else if($data->num_rows > 0)
        {   
            $this->setUser($username, $password);
            exit('success');
        }
        else
        {
            exit('Failed to login!');
        }


    }

    private function setUser($username, $password)
    {
        $sql = $this->conn->query("SELECT id FROM users WHERE username='$username' AND password='$password'");
        $result = $sql->fetch_row();
        $_SESSION['user_id'] = $result[0];
        $_SESSION['username'] = $username;
    }

    // Logout
    public function logout()
    {
        unset($_SESSION['loggedIn']);
        session_destroy();
        exit('success');
    }

    // Insert
    public function insert(Book $book)
    {
        $name = $this->conn->real_escape_string($book->name);
        $author = $this->conn->real_escape_string($book->author);
        $year = $book->year;
        $number_pages = $book->number_pages;
        $user_id = $book->user_id;
        $category_id = $book->category_id;

        $data = $this->conn -> query("SELECT * FROM books WHERE name='$name' AND author='$author'");

        if($data->num_rows > 0)
        {
            exit("Book with this name and author already exists!");
        }
        else
        {
            $result = $this->conn -> query("INSERT INTO books (name, author, year, number_pages, user_id, category_id) VALUES('$name', '$author', '$year', '$number_pages', '$user_id', '$category_id')");

            if($result)
            {
                exit('success'); 
            }
        }
    }

    // Update
    public function update(int $id, Book $book)
    {
        $name = $this->conn->real_escape_string($book->name);
        $author = $this->conn->real_escape_string($book->author);
        $year = $book->year;
        $number_pages = $book->number_pages;
        $user_id = $book->user_id;
        $category_id = $book->category_id;

        // $output = sprintf("<script>%s</script>", $id);
        // exit($output);

        $data = $this->conn -> query("UPDATE books SET name='$name', author='$author', year=$year, number_pages=$number_pages, user_id=$user_id, category_id=$category_id WHERE id=$id");

        if($data)
        {
            exit('success');
        }
    }

    // Delete
    public function delete(int $id)
    {
        $data = $this->conn -> query("DELETE FROM books WHERE id=$id");



        if($data)
        {
            $data_to_return = array(
                'success' => true,
                'message' => 'Successfully deleted!'
            );     
        }
        else
        {
            $data_to_return = array(
                'success' => false,
                'message' => 'Error while deleting!'
            );
        }

        exit(json_encode($data_to_return));
    }

    // Get All
    public function getAllBooks(){
        $user_id = intval($_SESSION['user_id']);

        $data = $this->conn -> query("SELECT id, name, author FROM books WHERE user_id=$user_id");

        $return_array = array();

        if($data->num_rows > 0)
        {
            while ($row = $data->fetch_array()) {
                $row_array['id'] = intval($row['id']);
                $row_array['name'] = $row['name'];
                $row_array['author'] = $row['author'];
        
                array_push($return_array,$row_array);
            }

            $data_to_return = new DataToReturn();
            $data_to_return->data = $return_array;
            $_SESSION['json_data'] = json_encode($data_to_return);
            exit("success");
        }
        else
        {
            $_SESSION['json_data'] = json_encode($return_array);
        }
    }

    // Get By Id
    public function getBookById(int $id)
    {
        $data = $this->conn -> query("SELECT * FROM books WHERE id=$id");
        $result = $data->fetch_array();

        $data_to_return = array(
            'name' => $result['name'],
            'author' => $result['author'],
            'year' => $result['year'],
            'numberOfPages' => $result['number_pages'],
            'category' => $result['category_id']
        );

        exit(json_encode($data_to_return));
    }

    // Get Categories
    public function getCategories()
    {
        $user_id = intval($_SESSION['user_id']);
        $data = $this->conn -> query("SELECT c.name AS category, COUNT(*) AS number FROM books b JOIN categories c ON (b.category_id = c.id) WHERE b.user_id = $user_id GROUP BY b.category_id");
        return $data;
    }

}
?>
