<?php
class ReporterModel {
	public function showAll() {
		
		$fc = FrontController::getInstance();
		$dbh = $fc->connect();
		$sql = "
			SELECT id,listenerName,listenerTitle,listenerMsg,status,reporterAnswer,moderatedTime 
				FROM `listener` WHERE status = 1 ORDER by moderatedTime
		";
		$sth = $dbh->prepare($sql);
		$sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		foreach ($result as $item) {
			if (empty($item['reporterAnswer'])) {
				echo "<div class='row' id='$item[id]'>
						<div class='col-lg-8'>
							<div class='msg-box'>
								<p>Слушатель: $item[listenerName] 
								<small class='pull-right'>Дата модерации сообщения:<i>".date('d-m-Y H:i:s',$item['moderatedTime'])."</i></small>
								</p>
								<p>Статус: $item[status]</p>
								<h4>$item[listenerTitle]</h4>
								<p>$item[listenerMsg]</p>\n
								<p><textarea name='reporterAnswer' cols='50' rows='3' placeholder='Введите ваше сообщение'></textarea></p>
								<button type='button' class='btn btn-success answer'>Ответить</button>
							</div>
						</div>
					</div>";
			}
		}
	}
	public function saveData ($id,$data) {
		//сохраняем ответ докладчика
		$sql = "
			UPDATE `listener` SET reporterAnswer = '$data', answeredTime = '".time()."'  WHERE id = $id
		";
		$fc = FrontController::getInstance();
		$dbh = $fc->connect();
		$result = $dbh->exec($sql);
		if ($result === false) {
			echo ('ERROR');
		}
	}
}