<?php require_once 'header.php'; ?>
<body>
  <section class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="/recipe/delete/<?= $id ?>">
                <p>Are you sure you would like to delete the recipe, '<?= $recipe["recipe_name"] ?>'?</p>
                <button class="addBtn" type="submit">Yes</button>
                <a class="removeBtn" href="/recipe/<?= $id ?>">No</a>
            </form>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
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