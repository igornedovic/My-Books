<?php
class Db {
    private $name;
    private $description;
    private $year;
    public $conn;
    private $rowID;

    function __construct()
    {
        $this->conn = new mysqli('localhost', 'root', '', 'mybooks');

        if ($this->conn->connect_errno) {
            exit("Connection failed: " . $this->conn->connect_error);
        }
    }

    // // Read
    // public function readAll(){
    //     $this->connect();
    //     $start = $this->conn->real_escape_string($_POST['start']);
    //     $limit = $this->conn->real_escape_string($_POST['limit']);

    //     $sql = $this->conn->query("SELECT id, name FROM films LIMIT $start, $limit");
    //     if ($sql->num_rows > 0) {
    //         $response = "";
    //         while($data = $sql->fetch_array()) {
    //             $response .= '
    //                 <tr>
    //                     <td>'.$data["id"].'</td>
    //                     <td id="film_'.$data["id"].'">'.$data["name"].'</td>
    //                     <td>
    //                         <input type="button" onclick="viewORedit('.$data["id"].', \'edit\')" value="Edit" class="btn btn-primary">
    //                         <input type="button" onclick="viewORedit('.$data["id"].', \'view\')" value="View" class="btn">
    //                         <input type="button" onclick="deleteRow('.$data["id"].')" value="Delete" class="btn btn-danger">
    //                     </td>
    //                 </tr>
    //             ';
    //         }
    //         exit($response);
    //     } else
    //         exit('reachedMax');
    // }

    // public function readById(){
    //     $this->connect();
    //     $rowID = $this->conn->real_escape_string($_POST['rowID']);
    //     $sql = $this->conn->query("SELECT name, description, year FROM films WHERE id='$this->rowID'");
    //     $data = $sql->fetch_array();
    //     $jsonArray = array(
    //         'name' => $data['name'],
    //         'year' => $data['year'],
    //         'description' => $data['description'],
    //     );

    //     exit(json_encode($jsonArray));
    // }

    // // Update
    // public function update(){
    //     $this->connect();
    //     $this->conn->query("UPDATE films SET name='$this->name', description='$this->description', year='$this->year' WHERE id='$this->rowID'");
    //     exit('success');
    // }

    // // Delete
    // public function delete(){
    //     $this->connect();
    //     $this->conn->query("DELETE FROM films WHERE id='$this->rowID'");
    //     exit('The film has been deleted!');
    // }

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
            $query = $this->conn -> query("INSERT INTO books (name, author, year, number_pages, user_id, category_id) VALUES('$name', '$author', '$year', '$number_pages', '$user_id', '$category_id')");

            if($query)
            {
                exit('success'); 
            }
        }
    }
}
?>