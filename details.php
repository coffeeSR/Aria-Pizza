<?php 

    include('config/db_connect.php');

    if(isset($_POST['delete'])){
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";

        if(mysqli_query($conn, $sql)) {
            //success
            header('Location:index.php');
        } {
            //failure 
            echo 'query error: ' . mysqli_error($conn);
        }
    }

    //check GET request id parameter
    if(isset($_GET['id'])){

        $id = mysqli_real_escape_string($conn, $_GET['id']);

        //make sql
        $sql = "SELECT * FROM pizzas WHERE id = $id";

        //get the query results
        $result = mysqli_query($conn, $sql);

        //fetch result in array format
        $pizza = mysqli_fetch_assoc($result);

        //free results and close the connection
        mysqli_free_result($result);
        mysqli_close($conn);

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>

    <?php include('templates/header.php'); ?>

    <div class="container center grey-text">

        <?php if ($pizza): ?>
            <h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
            <p>Created By: <?php echo htmlspecialchars($pizza['email']); ?></p>
            <p><?php echo htmlspecialchars($pizza['created_at']); ?></p>
            <p>Ingredients: <?php echo htmlspecialchars($pizza['ingredients']); ?></p>

            <!-- DELETE FORM -->
             <form action="details.php" method = "POST">
                <input type="hidden" name = "id_to_delete" value = "<?php echo $pizza['id'] ?>">
                <input type="submit" name="delete" value = "Delete" class = "btn brand z-depth-0">
             </form>

        <?php else: ?>
            <h4><?php echo "No such pizzas exist!" ?></h4>
        <?php endif ?>

    </div>

    
    <?php include('templates/footer.php'); ?>

</html>