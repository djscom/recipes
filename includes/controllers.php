<?php
function recipe_category_action($view){
    $menu = get_menu();
    $recipe = get_recipe_category($view);
    if($recipe == null){
        header('HTTP/1.1 404 Not Found');
        echo '<html><body><h1>Page Not Found</h1></body></html>';
    }
    else{
        require 'templates/index.php';
    }
}

function list_recipes_action(){
    $menu = get_menu();
    $recipe = get_all_recipes();
    require 'templates/index.php';
}

function recipe_detail_action($recipe){
    $recipe = get_recipe($recipe);
    if($recipe == null){
        header('HTTP/1.1 404 Not Found');
        echo '<html><body><h1>Page Not Found</h1></body></html>';
    }
    else{
        require 'templates/detail.php';
    }
}

function view_add_recipe_action(){
    $menu = get_menu();
    require 'templates/addrecipe.php';
}

function view_login(){
	$menu = get_menu();
	require 'templates/login.php';
}

function logout(){
	require 'templates/logout.php';
}

function add_recipe_action($name, $description, $methods, $ingredients){
    $menu = get_menu();
    add_recipe($name, $description, $methods, $ingredients);
    require 'templates/addrecipe.php';
}

function edit_recipe_action($id){
    $menu = get_menu();
    $recipe = get_recipe_by_id($id);
    require 'templates/editrecipe.php';
}

function update_recipe_action($id, $name, $description, $methods, $ingredients){
    $menu = get_menu();
    $recipe = update_recipe($id, $name, $description, $methods, $ingredients);
    require 'templates/editrecipe.php';
}

function view_delete_recipe_action($id){
    $menu = get_menu();
    $recipe = get_recipe($id);
    require 'templates/deleterecipe.php';
}

function delete_recipe_action($id){
    delete_recipe($id);
    header("Location: /");
}
?>
