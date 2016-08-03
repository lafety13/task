<?php include_once ROOT . '/views/layout/header.php'; ?>  

<div class="container">

    <div class="starter-template">
    <h2>Login to your account</h2>
    <br>login: Vadim<br>passwod: 123
    	<?php if (is_array($errors)): ?>
			<ul>
				<?php foreach ($errors as $err): ?>
					<li class="list-inline" style="color: red"><?=$err;?></li>
				<?php endforeach;?>
			</ul>
		<?php endif;?>

    <form class="my-form" action="" method="post">
    <frame>
    	Name:<br>
    	<input type="text" class="form-control" placeholder="Введите имя" name="name">
    	Password:<br>
    	<input type="text" class="form-control" placeholder="Введите пароль" name="password"><br>
    	<input type="submit" name="submit" class=""><br>
    </frame>
    </form>
    </div>

</div><!-- /.container -->

<?php include_once ROOT . '/views/layout/footer.php'; ?>  