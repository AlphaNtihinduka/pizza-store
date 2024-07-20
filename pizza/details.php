<?php 

    $db_connect = mysqli_connect("localhost", "alpha", "alpha123", "alpha_pizzas");

    if(!$db_connect) {
        echo 'connection error: ' . mysqli_connect_error();
    }

    if(isset($_GET['id'])) {

        // prevent sql injection
        $id = mysqli_real_escape_string($db_connect, $_GET['id']);

        // Create sql
        $sql = "SELECT * FROM pizzas WHERE id=$id";

        // make a query
        $result = mysqli_query($db_connect, $sql);

        // fetch pizza
        $pizza = mysqli_fetch_assoc($result);

        // free queries
        mysqli_free_result($result);

        // close connection
        mysqli_close($db_connect);
    }

?>


<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>
    <h4 class="center grey-text">Details</h4>
    <div class="container center">
		<?php if($pizza): ?>
			<h4><?php echo  htmlspecialchars($pizza['title']); ?></h4>
			<p>Created by <?php echo  htmlspecialchars($pizza['email']); ?></p>
			<p><?php echo  date($pizza['created_at']); ?></p>
			<h5>Ingredients:</h5>
			<p><?php echo  htmlspecialchars($pizza['ingredients']); ?></p>
		<?php else: ?>
			<h5>No such pizza exists.</h5>
		<?php endif ?>
	</div>

<?php include('templates/footer.php'); ?>

</html>