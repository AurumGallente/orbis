<script type="text/javascript" src="http://orbis/js/moderator.js"></script>
<?php
	//инициализируем данные из БД
	$modModel = new ModeratorModel ();
	$modModel->showAll();
?>