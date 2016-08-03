<?php include_once ROOT . '/views/layout/header.php'; ?>  

<div class="container">
    
	<div class="well">

			<?php if (isset($reviews) && !empty($reviews)): ?>
				<?php foreach ($reviews as $key ): ?>
					<?php if ($key['confirm'] == 1): ?>
						<table class="table " cellpadding="3">
							<tbody>	
								<tr>
									<td>
										Имя: 
									</td>
									<td> 
										<?=$key['name']?>
									</td>
								</tr>
								<tr>
									<td>
										Сообщение: 
									</td>
									<td style="word-wrap: break-word; width: 50px; "> 
										<?=$key['text']?>
									</td>
								</tr>
								<tr>
									<td>
										<?php if ($key['edit'] == 1): ?>
											<p><b>(Отредактировано админом)</b></p>
										<?php endif;?>
										<a href="/admfeedback/edit/<?=$key['id']?>">Редактировать запись</a>
									</td>
									<td>
									<?php if (!empty($key['img'])): ?>
										<img src="/tamplate/uploaded/<?=$key['img'] . '.jpg'?>">
									<?php endif;?>
									</td>
								</tr>
							</tbody>
						</table>
					<?php endif;?>
				<?php endforeach; ?>
			<?php endif; ?>
			<?php if ($errors): ?>
				<ul>
					<?php foreach ($errors as $err): ?>
						<li class = "list-inline" style="color: red"><?=$err;?></li>
					<?php endforeach;?>
				</ul>
			<?php endif;?>

			<form class="my-form" action= "" method= "POST" id="form" enctype="multipart/form-data">
				<div class="form-group">
					<label>Имя</label>
					<input type="text" name="name" class="form-control" placeholder="Введите имя">
				</div>
				<div class="form-group">
					<label for="email">Е-майл</label>
					<input type="email" class="form-control" placeholder="Введите email" name="email">
				</div>


				<div class="form-group">
					<label>Коментарий</label>
					<textarea class="form-control" placeholder="Введите коментарий" rows= "3" cols= "16" id = "text" name= "text"></textarea>
				</div>

				<div class="form-group">
					<label>Ваш файл</label>
					<input class="form-control" type="file" name="file">
					<p class="help-block">Не более метра</p>
				</div>

				<input name="submit" class="btn btn-default" type= "submit" value= "Отправить" id="butt" onsubmit=""> 
				<input name="pre" class="btn btn-default" type= "submit" value= "preview" id="pre" onclick=""> 
			</form>




		
	</div>
</div>


<?php include_once ROOT . '/views/layout/footer.php'; ?>  