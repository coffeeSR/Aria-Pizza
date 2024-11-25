<?php 

//connect db
include('config/db_connect.php');

$title = $email = $ingredients = '';

$errors = array('email' => '', 'title' => '', 'ingredients' => '');

 if(isset($_POST['submit'])) {
        // echo htmlspecialchar($_POST['email']);
        // echo htmlspecialchar($_POST['title']);
        // echo htmlspecialchar($_POST['ingredients']);

        //check email
        if(empty($_POST['email'])) {
            $errors['email'] = 'An email is required <br/>';
            } else {
                $email = $_POST['email'];
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = 'Email must be a valid email address'.'<br/>';
                }
            }

        //check title
        if(empty($_POST['title'])) {
            $errors['title'] = 'A title is required <br/>';
            } else {
                $title = $_POST['title'];
                if(!preg_match('/^[a-zA-Z\s]+$/', $title)) {
                    $errors['title'] = 'Title must be letters and spaces only'.'<br/>';
                }
            }


        //check ingredients
        if(empty($_POST['ingredients'])) {
            $errors['ingredients'] = 'At least one ingredient is required <br/>';
            } else {
                $ingredients = $_POST['ingredients'];
                if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
                    $errors['ingredients'] = "Ingredients must be a comma separated list";
                }
            }

            if(array_filter($errors)) {
                //echo errors in the form
            } else {
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $email = mysqli_real_escape_string($conn, $_POST['title']);
                $email = mysqli_real_escape_string($conn, $_POST['ingredients']);

                //create sql
                $sql = "INSERT INTO pizzas(title, email, ingredients) VALUES('$title', '$email', '$ingredients')";

                //save to db and check
                if(mysqli_query($conn, $sql)) {
                    //success
                    //echo form is valid
                    //save the data if valid & no error
                    //redirect to home page if no error
                    header('Location: index.php');
                } else {
                    //error
                    echo 'query error: ' . mysqli_error($conn);
                }

                
            }

        }   //end of POST check
    
?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>
<section class="container grey-text">
    <h4 class="center">Add a pizza</h4>
    <form action="add.php" class='white' method='POST'>
        
        <label for="email">Your Email</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
        <div class="red-text"><?php echo $errors['email'] ?></div>
        
        <label>Pizza title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
        <div class="red-text"><?php echo $errors['title'] ?></div>
        
        <label>Ingredients (comma separated)</label>
        <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
        <div class="red-text"><?php echo $errors['ingredients'] ?></div>
        
        <div class="center">
            <input type="submit" name="submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>

<?php include('templates/footer.php'); ?>

</html>