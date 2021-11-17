<?php
    require_once "db.php";
    include "inc/header.php";

    if(!isset($_SESSION['user_id'])){
        header('Location: index.php');
        exit();
    }

    $db = new Db();
    $result = $db->getCategories();

?>

<br />
<div class="container">
    <div class="row">
        <div class="col-6">
            <h2 class="text-info">Categories</h2>
        </div>
        <div class="col-3 offset-3">
            <a id="btn-add-new" class="btn btn-info form-control text-white" onclick="sortDescending()"> 
                Sort descending
            </a>
        </div>

        <div class="col-6 p-3 offset-3">
            <table id="category-table" class="table table-striped table-bordered" style="width:100%; text-align: center">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Number of books</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($result->num_rows > 0)
                    {
                        while($row = $result->fetch_array()):
                    ?>
                    <tr>
                        <td><?php echo $row["category"]?></td>
                        <td><?php echo $row["number"]?></td>
                    </tr>
                    <?php
                        endwhile;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
    include "inc/footer.php";
?>