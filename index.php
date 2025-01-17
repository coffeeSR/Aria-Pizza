<?php 
    include('config/db_connect.php');

    //write query for all pizzas
    $sql = 'SELECT title, ingredients, id FROM pizzas ORDER BY created_at';

    //make query and get result
    $result = mysqli_query($conn, $sql);

    //fetch the resulting rows as array
    $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);
   

    //free result from memory
    mysqli_free_result($result);

    //close connection
    mysqli_close($conn);


?>


<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<h3 class="center grey-text">Pizzas</h3>

<div class="container">
    <div class="row">
    
    <?php foreach ($pizzas as $pizza):  ?>
            <div class="col s6 md3">
                <div class="card z-depth-0">
                    <img src="images/pizza.png" alt="" class="pizza">
                    <div class="card-content center">
                        <!-- //title -->
                        <h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
                        <!-- ingredients -->
                       <ul>
                        <?php foreach (explode(',',$pizza['ingredients']) as $ing): ?>
                            <li><?php echo htmlspecialchars($ing); ?></li>
                        <?php endforeach ?>
                       </ul>


                    </div>
                    <div class="card-action right-align">
                        <a href="details.php?id=<?php echo $pizza['id'] ?>" class="brand-text">More Info</a>
                    </div>
                </div>
            </div>
    <?php endforeach; ?>
    


    </div>
</div>

<?php include('templates/footer.php'); ?>


</body>
</html>