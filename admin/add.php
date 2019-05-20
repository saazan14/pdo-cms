<?php
session_start();
include_once('../includes/connection.php');

if (isset($_SESSION['logged_in'])) {
	if (isset($_POST['title'], $_POST['content'])) {
		$title = $_POST['title'];
		$content = nl2br($_POST['content']);

		if (empty($title) or empty($content)){
			$error = "Oh ! All feilds are requied.";
		} else {
			$query = $pdo->prepare('INSERT INTO articles (article_title, article_content, article_timestamp) VALUES (?, ?, ?)');
			$query->bindValue(1, $title);
			$query->bindValue(2, $content);
			$query->bindValue(3, time());
			$query->execute();

			header('Location: ../.');
		}
	}
	?>
<?php include_once('../includes/headerX.php'); ?>
<div class="container">
	<a href="." id="logo"><h1>CMS</h1></a>
	<h2>Add Article</h2>
	<?php if (isset($error)) { ?>
		<small style="color: #aa0000"><?php echo $error; ?>
			<br><br>
		</small>
	<?php } ?>
	<form action="add.php" method="post" autocomplete="off">
		<input type="text" name="title" placeholder="Title" size="70"><br>
		<textarea rows="15" cols="53" name="content" placeholder="Content"></textarea><br>
		<input type="submit" name="submit" value="Add Article">
	</form>
	<br>
	<a href=".">&larr;Cancel</a> 
	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; |
	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
	<a href="../.">&rarr;Blog</a> 
	
</div>	
<?php include_once('../includes/footer.php'); ?>	

	<?php
} else {
	header('Location: index.php');
}

?>