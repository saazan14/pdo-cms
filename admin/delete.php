<?php
	session_start();
	include_once('../includes/connection.php');
	include_once('../includes/article.php');

	$article = new Article;

	if (isset($_SESSION['logged_in'])) {
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$query = $pdo->prepare('DELETE FROM articles WHERE article_id = ?');
			$query->bindValue(1, $id);
			$query->execute();
			 header('Location: delete.php'); 
		}
		$articles = $article->fetch_all();
	?>
	<?php include_once('../includes/headerX.php'); ?>
		<div class="container">
			<a href="." id="logo"><h1>CMS</h1></a>
			<h2>Select Article to Delete</h2>
			<?php if (isset($error)) { ?>
				<small style="color: #aa0000"><?php echo $error; ?>
					<br><br>
				</small>
			<?php } ?>
			<form action="delete.php" method="get" autocomplete="off">
				<select onchange="this.form.submit()" name="id" style="width: 33em;">
					<?php foreach ($articles as $article) { ?>
						<option value="<?php echo $article['article_id']; ?>">
							<?php echo $article['article_title'];?>
						</option>
					<?php }	?>
				</select>
			</form>
			<br>
			<a href="../.">&larr; Blog</a>
			
		</div>	
	<?php include_once('../includes/footer.php'); ?>	

	<?php
	} else {
		header('Location : index.php');
	}

	

?>