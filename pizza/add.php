<?php 

    $db_connect = mysqli_connect("localhost", "alpha", "alpha123", "alpha_pizzas");

    if(!$db_connect) {
        echo 'connection error: ' . mysqli_connect_error();
    }

    $email = $title = $ingredients = '';
    if(isset($_POST['submit'])) {


        $errors = array('email'=>'', 'title'=>'', 'ingredients'=>'');
        if(empty($_POST['email'])) {
            $errors['email'] =  'Email is required';
        } else {
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Input valid email";
            } else {
                echo  htmlspecialchars($_POST['email']);
            }
        }

        if(empty($_POST['title'])) {
            $errors['title'] = 'Title is required';
        } else {
            $title = $_POST['title'];
            if(preg_match('/[^a-zA-Z]/', $title)) {
                $errors['title'] = "Input texts only";
            } else {
               echo  htmlspecialchars($_POST['title']);
            }
            
        }

        if(empty($_POST['ingredients'])) {
            $errors['ingredients'] =  'At least one ingredient is required';
        } else {

            $ingredients = $_POST['ingredients'];
            if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
                $errors['ingredients'] = "Use comma for ingredients";
            } else {
               echo  htmlspecialchars($_POST['ingredients']);
            }           
        }

        if(array_filter($errors)) {
            echo "failed to add pizza";
        
        } else {

            // prevent mysql injection
            $title = mysqli_real_escape_string($db_connect, $_POST['title']);
            $email = mysqli_real_escape_string($db_connect, $_POST['email']);
            $ingredients = mysqli_real_escape_string($db_connect, $_POST['$ingredients']);
            
            // create a query
            $sql = "INSERT INTO pizzas(title, email, ingredients) VALUES('$title', '$email', '$ingredients')";
            
            // make a query and save
            if(mysqli_query($db_connect, $sql)){
                header('location: index.php');
            } else {
                echo 'query error: ' . mysqli_connect_error($db_connect);
            }

        }
    }
   

?>

<?php include('templates/header.php'); ?>

	<section class="container grey-text">
		<h4 class="center">Add a Pizza</h4>
		<form class="white" action="add.php" method="POST">
			<label>Your Email</label>
			<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
            <div class='red-text'><?php echo $errors['email'] ?></div>
			<label>Pizza Title</label>
			<input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
            <div class='red-text'><?php echo $errors['title'] ?></div>
			<label>Ingredients (comma separated)</label>
			<input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
            <div class='red-text'><?php echo $errors['ingredients'] ?></div>
			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>