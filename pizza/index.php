<?php 

 
    $db_connect = mysqli_connect("localhost", "alpha", "alpha123", "alpha_pizzas");

    if(!$db_connect) {
        echo 'connection error: ' . mysqli_connect_error();
    }


// querry for all pizzas
    $sql = 'SELECT id, title, ingredients FROM pizzas ORDER BY created_at';

    // make a querry and get results
    $result = mysqli_query($db_connect, $sql);

    // fetch data from database

    $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // $pizzas = array();
    // while($pizza = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    //     $pizzas[] = $pizza;
    // }
    
    // free result from memory
    mysqli_free_result($result);

    // close connection
    mysqli_close($db_connect);

?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>
<h4 class="center grey-text">Pizzas!</h4>

	<div class="container">
		<div class="row">

			<?php foreach($pizzas as $pizza): ?>

				<div class="col s6 md3">
					<div class="card z-depth-0">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
							<ul class="grey-text">
								<?php foreach(explode(',', $pizza['ingredients']) as $ingredient): ?>
									<li><?php echo htmlspecialchars($ingredient); ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="details.php?id=<?php echo $pizza['id'] ?>">more info</a>
						</div>
					</div>
				</div>

			<?php endforeach; ?>

		</div>
	</div>
<?php include('templates/footer.php'); ?>

</html>
