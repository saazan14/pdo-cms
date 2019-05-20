<?php
session_start();

include_once('../includes/connection.php');
include_once('../includes/article.php');

if (isset($_SESSION['logged_in'])) {
	?>
	<?php include_once('../includes/headerX.php'); ?>
	<div class="container">
		<a href="." id="logo"><h1>CMS</h1></a>		
		<ol>
			<li><a href="add.php">Write Article</a></li>
			<li><a href="delete.php">Remove Article</a></li>
			<!-- <li><a href="logout.php">Admin Logout</a></li> -->
		</ol>
		<?php 
		$article = new Article;
		$articles = $article->fetch_all();
		?>
		<ol>
			<?php foreach ($articles as $article) { ?>
			<li>
				<a class="article" href="../article.php?id=<?php echo $article['article_id'];?>"><?php echo $article['article_title'];?></a> 
				<small>
					<i class="far fa-calendar-alt"></i>
					<?php echo date('jS Y, l', $article['article_timestamp']);?>
					<i class="far fa-clock"></i>
					<?php echo date('g:i A', $article['article_timestamp']);?>
				</small>
			</li>
			<?php } ?>
		</ol>
		<a href="../">&larr; Home</a> 
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; |
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		<a href="logout.php">Logout &rarr;</a>

		
	</div>	
	<?php include_once('../includes/footer.php'); ?>	


	<?php
} else {
	if (isset($_POST['username'], $_POST['password'])) {
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		if (empty($username) or empty($password)) {
			$error = "Oh ! All feilds are required.";
		} else {
			$query = $pdo->prepare("SELECT * FROM users WHERE user_name = ? AND user_password = ? ");
			$query->bindValue(1, $username);
			$query->bindValue(2, $password);

			$query->execute();

			$num = $query->rowCount();
			if ($num == 1) {
				$_SESSION['logged_in'] = true;
				header('Location: index.php');
				exit();
			} else {
				$error = "Oh ! Incorrect Username / Password";
			}

		}
	}
	?>

<?php include_once('../includes/headerX.php'); ?>
<div class="container">
	<a href="." id="logo"><h1>CMS</h1></a>
	<?php if (isset($error)) { ?>
		<small style="color: #aa0000"><?php echo $error; ?>
			<br><br>
		</small>
	<?php } ?>
	<form action="index.php" method="post" autocomplete="off"> 
		<input type="text" name="username" placeholder="Username">
		<input type="password" name="password" placeholder="Password">
		<input type="submit" value="Login">

	</form>
	<br>
	<a href="../.">&larr; Blog</a>
</div>	
<?php include_once('../includes/footer.php'); ?>

	<?php
}

