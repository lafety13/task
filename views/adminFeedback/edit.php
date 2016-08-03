<?php include_once ROOT . '/views/layout/header.php'; ?>  

<div class="container">
    
	<div class="well">

		<div class="form-group">
			<?php if ($errors): ?>
				<ul>
					<?php foreach ($errors as $err): ?>
						<li class = "list-inline" style="color: red"><?=$err;?></li>
					<?php endforeach;?>
				</ul>
			<?php endif;?>
		</div>
			<form class="my-form" action= "" method= "POST" id="form" enctype="multipart/form-data">
				<div class="form-group">
					<label>Имя</label>
					<input type="text" name="name" class="form-control" placeholder="Введите имя" value="<?=$review['name']?>" disabled>
				</div>
				<div class="form-group">
					<label for="email">Е-майл</label>
					<input type="email" class="form-control" placeholder="Введите email" name="email" value="<?=$review['email']?>" disabled>
				</div>


				<div class="form-group">
					<label>Коментарий</label>
					<textarea class="form-control" placeholder="Введите коментарий" rows= "10" cols= "30" id = "text" name= "text" ><?=$review['text']?></textarea>
				</div>


				<input name="submit" class="btn btn-default" type= "submit" value= "Редактировать" id="butt" onsubmit=""> 
				
			</form>




		
	</div>
</div>


<?php include_once ROOT . '/views/layout/footer.php'; ?>  