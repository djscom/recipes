<?php require_once 'header.php'; ?>
<body>
	<header class="container">
	<?php require_once 'menu.php'; ?>
	</header>
	<section class="main container">
		<div class="row">
			<div class="col-md-12">
				<form id="form1" method="POST" action="/recipe/add">
					<div id="recipename">
						<p>Add Recipe Name</p>
						<input type="text" name="srecipename" placeholder="My Recipe Name">
					</div>
					<div id="description">
						<p>Add Description</p>
						<textarea rows=4 name="sdescription"></textarea>
					</div>
					<div id="methods">
						<p>Add Method</p>		
						<input type="text" name="amethods[]" placeholder="Method"><button class="addBtn" onclick="inputs.addInput(event)">+</button>
					</div>
					<div id="ingredients">
						<p>Add Ingredients</p>		
						<input type="text" name="aingredients[]" placeholder="Ingredient"><button class="addBtn" onclick="inputs.addInput(event)">+</button>
					</div>					
					<div id="submit">
						<input type="submit" value="Submit">
					</div>
				</form>
			</div>
		</div>
	</section>
	<script src="/form.js"></script>
</body>
</html>
