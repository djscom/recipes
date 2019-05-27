<?php require_once 'header.php'; ?>
<body>
<header class="container">
<?php require_once 'menu.php'; ?>
</header>
<section class="main container">
<?php
foreach ($recipe as $recipeitem){
	echo '<div class="recipe">';
	echo '<h2>'.'<a href="/recipe/'.slug($recipeitem['recipe_name']).'">'.$recipeitem['recipe_name'].'</a></h2>';
	if(strlen($recipeitem['description']) > 150){
		echo '<p>'.substr($recipeitem['description'],0,150).'...</p>';
	}
	else{
		echo '<p>'.$recipeitem['description'].'...</p>';
	}
	echo '<p>Source: '.$recipeitem['source'].'</p>';
	echo '<a href="/recipe/'.slug($recipeitem['recipe_name']).'">'.'see recipe</a>';
	echo '</div>';
}
function slug($string){
	$string = str_replace('-','+',$string);
	$string = str_replace(' ','-',$string);
	return strtolower($string);
}
?>
</section>
<footer class="container">
	<div class="row">
		<div class="col-md-12 text-center">
		</div>
	</div>
</footer>
</body>
</html>
