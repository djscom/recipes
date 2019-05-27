<?php
require_once '../includes/models.php';
require_once '../includes/controllers.php';

// route the request internally
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

if ('category' === $uri[1] && count($uri) == 3){
	recipe_category_action($uri[2]);
} elseif ('' === $uri[1]) {
    list_recipes_action();
} elseif ('recipe' === $uri[1] && 'add' === $uri[2] && $_SERVER["REQUEST_METHOD"] == "POST"){
	add_recipe_action($_POST["srecipename"], $_POST["sdescription"], $_POST["amethods"], $_POST["aingredients"]);
} elseif ('recipe' == $uri[1] && 'edit' === $uri[2] && count($uri) == 4 && $_SERVER["REQUEST_METHOD"] == "POST"){
    update_recipe_action($uri[3], $_POST["srecipename"], $_POST["sdescription"], $_POST["amethods"], $_POST["aingredients"]);
} elseif ('recipe' == $uri[1] && 'edit' === $uri[2] && count($uri) == 4){
    edit_recipe_action($uri[3]);
} elseif ('recipe' === $uri[1] && 'add' === $uri[2]){
	view_add_recipe_action();
} elseif ('recipe' === $uri[1] && 'delete' === $uri[2] && count($uri) == 4 && $_SERVER["REQUEST_METHOD"] == "POST"){
    delete_recipe_action($uri[3]);
} elseif ('recipe' === $uri[1] && 'delete' === $uri[2] && count($uri) == 4){
    view_delete_recipe_action($uri[3]);
} elseif ('recipe' === $uri[1] && count($uri) == 3) {
    recipe_detail_action($uri[2]);
} elseif ('login' === $uri[1]){
	view_login();
} elseif('logout' === $uri[1]){
	logout();
} else {
    header('HTTP/1.1 404 Not Found');
    echo '<html><body><h1>Page Not Found</h1></body></html>';
}
?>
