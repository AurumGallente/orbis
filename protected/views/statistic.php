<table class="table table-bordered table-hover table-striped">
	<tr>
		<td>Слушатель</td>
		<td>Вопрос</td>
		<td>Статус</td>
		<td>Дата модерации сообщения</td>
	</tr>
	<?php
	$model = new StatisticModel();
	$model->showAll();
	?>
</table>