<?php
$addclass = "";
$loginclass = "";
if("/recipe/add" === $_SERVER['REQUEST_URI']){
	$addclass = 'current';
} elseif("/login" === $_SERVER['REQUEST_URI']){
	$loginclass = 'current';
}
?>
<nav class="container">
        <div class="row">
                <div class="col-md-12">
			<ul id="navigation">
				<li><h1>Jessica's recipes</h1></li>
<?php
foreach ($menu as $menuitem){
	$class = '';
	if("/category/".$menuitem['category'] === $_SERVER['REQUEST_URI']){
		$class = 'current';
	}
        echo '<li><a href="/category/'.$menuitem['category'].'" class="'.$class.'">'.ucfirst($menuitem['category']).' ('.$menuitem['count'].')</a></li>';
}
?>
	<li><?php if ($_SESSION["valid"]){ ?><a class="<?php echo $addclass; ?>" href="/recipe/add">Add new</a></li>
	<li><a href="/logout">Logout</a><?php }else{?><a class="<?php echo $loginclass; ?>" href="/login">Login</a><?php } ?></li>
                        </ul>
                </div>
        </div>
</nav>
