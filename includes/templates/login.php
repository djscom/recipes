<?php require_once 'header.php'; ?>
<?php
            $msg = 'Login';
            
            if (isset($_POST['login']) && !empty($_POST['username']) 
               && !empty($_POST['password'])) {
				
               if ($_POST['username'] == 'derek' && 
                  $_POST['password'] == 'cyclops10' || $_POST['username'] == 'mom' &&
                  $_POST['password'] == 'finding2nemo') {
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = 'derek';
                  
                  $msg=  'You have entered valid use name and password';
               }else {
                  $msg = 'Wrong username or password';
               }
            }
         ?>
<body>
	<header class="container">
<?php require_once 'menu.php'; ?>	
</header>
<section class="main container">
		<div class="row">
			<div class="col-md-12" style="text-align:center">
<?php if($_SESSION['valid']){ ?>
		<h2>Welcome <?= $_SESSION['username']?></h2>
		<p>Would you like to?</p>
		<ul>
		<li><a href="/recipe/add">Add new recipe</a></li>
		</ul>
<?php } else{ ?>
<form class="form-signin" role="form" action="/login" method="post">
<h2 class="form-signin-heading"><?php echo $msg; ?></h2>
<input type="text" class="form-control" name="username" placeholder="username" required autofocus></br>
<input type="password" class="form-control" name="password" placeholder="password" required><br />
<button class="login" type="submit" name="login">Login</button>
</form>	<?php } ?>		
			</div>
		</div>
	</section>
	<script src="/form.js"></script>
</body>
</html>
