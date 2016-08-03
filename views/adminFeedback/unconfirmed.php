<?php include_once ROOT . '/views/layout/header.php'; ?>  

<div class="container">
    
	<div class="well">

			<?php if (isset($reviews) && !empty($reviews)): ?>
				<?php foreach ($reviews as $key ): ?>
					<?php if ($key['confirm'] == 0): ?>
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
										<?php if (!empty($key['img'])): ?>
											<img src="/tamplate/uploaded/<?=$key['img'] . '.jpg'?>">
										<?php endif;?>
									</td>
									<td>
										
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
										<?php if ($key['confirm'] == 1): ?>
											Принято
										<?php else: ?>
											<a href="/confirm/<?=$key['id']?>">Принять</a> | <a href="">Не принять</a>
										<?php endif; ?>
									</td>
								</tr>
							</tbody>
						</table>
					<?php endif;?>
				<?php endforeach; ?>
			<?php endif; ?>
	</div>
</div>


<?php include_once ROOT . '/views/layout/footer.php'; ?>  