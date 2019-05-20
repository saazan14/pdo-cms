<?php
include_once('includes/connection.php');
include_once('includes/article.php');

$article = new Article;

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$data = $article->fetch_data($id);

	//print_r($data);
?>

<?php include_once('includes/header.php'); ?>
<div class="container">
	<!-- <a href="." id="logo"><h1>CMS</h1></a> -->
	<h1><?php echo $data['article_title']?></h1>
	<small>
		Published : 
		<i class="fas fa-pencil-alt"></i> 
		<?php echo date('jS Y, l', $data['article_timestamp']);?>
		<i class="far fa-clock"></i>
		<?php echo date('g:i A', $data['article_timestamp']);?>
	</small>
	<p><?php echo nl2br($data['article_content']);?></p>

	<a href=".">&larr; Back</a>

</div>	
<?php include_once('includes/footer.php'); ?>

<?php
} else {
	header('Location : index.php');
	exit();
}


?>


