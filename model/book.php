<?php
class Book {
    public $id;
    public $name;
    public $author;
    public $year;
    public $number_pages;
    public $user_id;
    public $category_id;

    public function __construct($id=null, $name=null, $author=null, $year=null, $number_pages, $user_id, $category_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->author = $author;
        $this->year = $year;
        $this->number_pages = $number_pages;
        $this->user_id = $user_id;
        $this->category_id = $category_id;
    }

}
?>