<?php
include_once('includes/connection.php');
include_once('includes/article.php');

$article = new Article;
$articles = $article->fetch_all();

// print_r($articles);

?>
<?php include_once('includes/header.php'); ?>
<div class="container">
	<a href="." id="logo"><h1>CMS</h1></a>
	<ol>
		<?php foreach ($articles as $article) { ?>
		<li>
			<a class="article" href="article.php?id=<?php echo $article['article_id'];?>"><?php echo $article['article_title'];?></a> 
			<small style="margin-left:1em;">
				<!-- <i class="fas fa-pencil-alt"></i>  -->
				<i class="far fa-calendar-alt"></i>
				<?php echo date('M Y', $article['article_timestamp']);?>
				<!-- <i class="far fa-clock"></i> -->
				<?php //echo date('g:i A', $article['article_timestamp']);?>

			</small>
		</li>
		<?php } ?>
	</ol>
	<br>
	<small><a href="admin">Admin</a></small>
</div>	
<?php include_once('includes/footer.php'); ?>


