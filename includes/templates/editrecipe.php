<?php require_once 'header.php'; ?>
<body>
	<header class="container">
	<?php require_once 'menu.php'; ?>
	</header>
	<section class="main container">
		<div class="row">
			<div class="col-md-12">
				<form id="form1" method="POST" action="/recipe/edit/<?= $id ?>">
					<div id="recipename">
						<p>Add Recipe Name</p>
						<input type="text" name="srecipename" placeholder="My Recipe Name" value="<?= $recipe["recipe_name"] ?>">
					</div>
					<div id="description">
						<p>Add Description</p>
						<textarea rows=4 name="sdescription"><?= $recipe['description'] ?></textarea>
					</div>
					<div id="methods">
						<p>Add Method</p>		
<?php foreach ($recipe["methods"] as $key=>$method){ ?><input type="text" name="amethods[]" value="<?= $method ?>" placeholder="Method"><?php if ($key > 0){ ?><button onclick="inputs.removeInput(event)">-</button><?php }} ?><button class="addBtn" onclick="inputs.addInput(event)">+</button>					
                    </div>
					<div id="ingredients">
						<p>Add Ingredients</p>
<?php foreach ($recipe["ingredients"] as $key=>$ingredient){ ?><input type="text" name="aingredients[]" value="<?= $ingredient ?>" placeholder="Ingredient"><?php if ($key > 0){ ?><button onclick="inputs.removeInput(event)">-</button><?php }} ?><button class="addBtn" onclick="inputs.addInput(event)">+</button>					
                    </div>					
					<div id="submit">
						<input type="submit" value="Save">
					</div>
				</form>
			</div>
		</div>
	</section>
	<script src="/form.js"></script>
</body>
</html>
