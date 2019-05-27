<?php

function open_connection(){
	try{
		$connection = new PDO('sqlite:/var/www/recipes/includes/database/recipes.sqlite');
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $connection;
	}
	catch(PDOException $ex) {
		echo $ex->getMessage();
		phpinfo();
		return null;
	}
}

function close_connection(&$connection){
	$connection = null;
}

function get_menu(){
	$connection = open_connection();
	$stmt = $connection->prepare("select count(*) as count, category from category group by category");
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	close_connection($connection);
	return $rows;
}

function get_all_recipes(){
	$connection = open_connection();
    $stmt = $connection->prepare("SELECT * FROM recipes order by recipe_name asc");
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	close_connection($connection);
	return $rows;
}

function get_recipe($recipe_name){
	$recipe_name = str_replace('-',' ',strtolower($recipe_name));
	$recipe_name = str_replace('+','-',$recipe_name);
	$connection = open_connection();
	$stmt = $connection->prepare("SELECT * FROM recipes where lower(recipe_name)=:recipe_name");
	$stmt->bindParam(':recipe_name', $param_recipe_name, PDO::PARAM_STR);
	$param_recipe_name = $recipe_name;
	$stmt->execute();
	$row = $stmt->fetch();
	$recipe = array('id' => $row['id'],
		'recipe_name' => $row['recipe_name'],
		'description' => $row['description'], 
		'ingredients' => get_ingredients($row['id']), 
		'methods' => get_methods($row['id'])
	);
	close_connection($connection);
	return $recipe;
}

function get_recipe_by_id($id){
        $connection = open_connection();
        $stmt = $connection->prepare("SELECT * FROM recipes where id=:id");
        $stmt->bindParam(':id', $param_id, PDO::PARAM_INT);
        $param_id = $id;
        $stmt->execute();
        $row = $stmt->fetch();
        $recipe = array('recipe_name' => $row['recipe_name'],
                'description' => $row['description'],
                'ingredients' => get_ingredients($row['id']),
                'methods' => get_methods($row['id'])
        );
        close_connection($connection);
        return $recipe;
}

function get_recipe_category($cat){
	$connection = open_connection();
	$stmt = $connection->prepare("SELECT recipes.*, category.category FROM recipes left join category on category.recipe_id=recipes.id where category.category=:category order by recipe_name asc");
	$stmt->bindParam(':category', $cat, PDO::PARAM_STR);
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	close_connection($connection);
	return $rows;
}

function get_ingredients($id){
	$connection = open_connection();
	$stmt = $connection->prepare("SELECT ingredient_name FROM ingredients where recipe_id=:id");
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
	close_connection($connection);
	return $rows;
}

function get_methods($id){
	$connection = open_connection();
	$stmt = $connection->prepare("SELECT method_step FROM methods where recipe_id=:id");
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
	close_connection($connection);
	return $rows;
}

function delete_recipe($id){
	$connection = open_connection();
	$stmt = $connection->prepare("DELETE FROM recipes WHERE id=:id");
	$stmt->bindParam(':id', $param_id, PDO::PARAM_INT);
	$param_id = $id;
	$stmt->execute();
	$stmt = $connection->prepare("DELETE FROM methods WHERE recipe_id=:id");
	$stmt->bindParam(':id', $param_id, PDO::PARAM_INT);
	$param_id = $id;
	$stmt->execute();
	$stmt = $connection->prepare("DELETE FROM ingredients WHERE recipe_id=:id");
	$stmt->bindParam(':id', $param_id, PDO::PARAM_INT);
	$param_id = $id;
	$stmt->execute();
	close_connection($connection);
}

function update_recipe($id, $name, $description, $methods, $ingredients){
	$connection = open_connection();
	$stmt = $connection->prepare("UPDATE recipes SET recipe_name=:recipe_name, description=:description WHERE id=:id");
	$stmt->bindParam(':recipe_name', $param_recipe_name, PDO::PARAM_STR);
	$stmt->bindParam(':description', $param_description, PDO::PARAM_STR);
	$stmt->bindParam(':id', $param_id, PDO::PARAM_STR);
	$param_recipe_name = $name;
	$param_description = $description;
	$param_id = $id;
	$stmt->execute();
	$stmt = $connection->prepare("DELETE FROM methods WHERE recipe_id=:id");
	$stmt->bindParam(':id', $param_id, PDO::PARAM_INT);
	$param_id = $id;
	$stmt->execute();
	foreach($methods as $method){
		$stmt = $connection->prepare("INSERT INTO methods (recipe_id, method_step) VALUES (:recipe_id, :method_step)");
		$stmt->bindParam(':recipe_id', $param_recipe_id, PDO::PARAM_INT);
		$stmt->bindParam(':method_step', $param_method_step, PDO::PARAM_STR);
		$param_method_step = $method;
		$param_recipe_id = $id;
		$stmt->execute();
	}
	$stmt = $connection->prepare("DELETE FROM ingredients WHERE recipe_id=:id");
	$stmt->bindParam(':id', $param_id, PDO::PARAM_INT);
	$param_id = $id;
	$stmt->execute();
	foreach($ingredients as $ingredient){
		$stmt = $connection->prepare("INSERT INTO ingredients (recipe_id, ingredient_name) VALUES (:recipe_id, :ingredient_name)");
		$stmt->bindParam(':recipe_id', $param_recipe_id, PDO::PARAM_INT);
		$stmt->bindParam(':ingredient_name', $param_ingredient_name, PDO::PARAM_STR);
		$param_ingredient_name = $ingredient;
		$param_recipe_id = $id;
		$stmt->execute();
	}
	return get_recipe($id);
}

function add_recipe($name, $description, $methods, $ingredients){
	$connection = open_connection();	
	$stmt = $connection->prepare("INSERT INTO recipes (recipe_name, description) VALUES (:recipe_name, :description)");
	$stmt->bindParam(':recipe_name', $param_recipe_name, PDO::PARAM_STR);
	$stmt->bindParam(':description', $param_description, PDO::PARAM_STR);	
	$param_recipe_name = $name;
	$param_description = $description;
	if($stmt->execute()){
		$irecipeid = $connection->lastInsertId();
		$amethods = $methods;
		foreach($amethods as $method){
			$stmt = $connection->prepare("INSERT INTO methods (recipe_id, method_step) VALUES (:recipe_id, :method_step)");
			$stmt->bindParam(':recipe_id', $param_recipe_id, PDO::PARAM_INT);
			$stmt->bindParam(':method_step', $param_method_step, PDO::PARAM_STR);
			$param_method_step = $method;
			$param_recipe_id = $irecipeid;
			$stmt->execute();
		}
		$aingredients = $ingredients;
		foreach($aingredients as $ingredient){
			$stmt = $connection->prepare("INSERT INTO ingredients (recipe_id, ingredient_name) VALUES (:recipe_id, :ingredient_name)");
			$stmt->bindParam(':recipe_id', $param_recipe_id, PDO::PARAM_INT);
			$stmt->bindParam(':ingredient_name', $param_ingredient_name, PDO::PARAM_STR);
			$param_ingredient_name = $ingredient;
			$param_recipe_id = $irecipeid;
			$stmt->execute();
		}
	}
	close_connection($connection);
}
?>
