<?php
    include 'inc/header.php';

    if(!isset($_SESSION['user_id'])){
        header('Location: index.php');
        exit();
    }

?>

<div class="text-center">
    <h1 class="display-4">Welcome to the MyBooks!</h1>
    <p style="font-style: italic;">A good book is an event in my life.</p>
    <img src="img/home.jpg" alt="pocetna" class="img-responsive" width="500"/>
</div>

<?php
    include 'inc/footer.php';
?>