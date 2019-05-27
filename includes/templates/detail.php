<?php require_once 'header.php'; ?>
<body class="detail">
  <section class="container">
    <div class="row">
      <div class="col-md-12">
        <a style="cursor:pointer;text-decoration:underline;" onclick="window.history.back()">back</a>
        <a href="" onclick="window.print();" style="float:right">print</a>
	<?php if ($_SESSION["valid"]){ ?>
	<a href="/recipe/delete/<?= $recipe['id'] ?>" style="float:right;margin:0 5px;">delete</a>
        <a href="/recipe/edit/<?= $recipe['id'] ?>" style="float:right">edit</a>
	<?php } ?>
	<h2><?= $recipe['recipe_name'] ?></h2>
        <p><?= $recipe['description'] ?></p>
        <h3>Ingredients</h3>
        <ul>
  <?php foreach ($recipe['ingredients'] as $ingredient){ ?>
        <li><?= $ingredient ?></li>
  <?php } ?>
      </ul>
        <h3>Method</h3>
        <ol>
  <?php foreach ($recipe['methods'] as $method){ ?>
        <li><?= $method ?></li>
  <?php } ?>
      </ol>
      </div>
    </div>
  </section>
</body>
</html>
