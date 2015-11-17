<?php
class ModeratorModel {
	
	public function showAll() {
		
		$fc = FrontController::getInstance();
		//подключаемся к БД
		$dbh = $fc->connect();
		//формируем и отправляем запрос
		$sql = "
			SELECT id,listenerName,listenerTitle,listenerMsg,status,reporterAnswer,createTime,answeredTime
				FROM `listener` 
					WHERE status = 0 OR (status = 1 AND reporterAnswer <> '') 
						ORDER BY createTime
		";
		$sth = $dbh->prepare($sql);
		$sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		//выводим данные из БД
		foreach ($result as $item) {
			echo "<div class='row' id='$item[id]'>";
			echo "<div class='col-lg-8'>
					<div class='msg-box'>
						<p>Слушатель: $item[listenerName] <small class='pull-right'><i>".date('d-m-Y H:i:s',$item['createTime'])."</i></small></p>
						<p>Статус: $item[status]</p>
						<h4>$item[listenerTitle]</h4>
						<p>$item[listenerMsg]</p>\n";
			if (!empty($item['reporterAnswer'])) {
				echo "<button type='button' class='btn btn-success approve' disabled='disabled'>Принять</button>\n";
			}else {
				echo "<button type='button' class='btn btn-success approve'>Принять</button>\n";
			}
			echo		"<button type='button' class='btn btn-danger deny'>Отклонить</button>\n";
			if ($item['status'] != 3 and !empty($item['reporterAnswer'])) {
				echo "<button type='button' class='btn btn-info archiv'>В архив</button>\n";
			} else {
				echo "<button type='button' class='btn btn-info archiv' disabled='disabled'>В архив</button>";
			}
			echo	"</div>
				</div>\n";
			if ($item['reporterAnswer']) {
				echo "<div class='col-lg-4'>
						<p><small class='pull-right'><i>".date('d-m-Y H:i:s',$item['answeredTime'])."</i></small><br />
							$item[reporterAnswer]
						</p>
					</div>\n";
			}
			echo "</div>\n";
		}
		
	}
	//Исходя из класса кнопки вызываем соответствующий метод, обновляем status и добавляем дату модерации
	public function getParams($id,$class) {
		switch ($class) {
			case 'approve' : $this->approve($id);break;
			case 'deny' : $this->deny($id);break;
			case 'archiv' : $this->archiv($id);break;
		}
	}
	public function approve ($id) {
		
		$fc = FrontController::getInstance();
		$dbh = $fc->connect();
		$sql = "
			UPDATE `listener` SET status = 1, del = 1, moderatedTime = '".time()."' WHERE id = '$id'
		";
		
		$result = $dbh->exec($sql);
		if ($result === false) {
			echo ('ERROR');
		}
	}
	public function deny ($id) {
		
		$fc = FrontController::getInstance();
		$dbh = $fc->connect();
		$sql = "
			UPDATE `listener` SET status = 2, del = 2, moderatedTime = '".time()."' WHERE id = '$id'
		";
		
		$result = $dbh->exec($sql);
		if ($result === false) {
			echo ('ERROR');
		}
	}
	public function archiv ($id) {
		
		$fc = FrontController::getInstance();
		$dbh = $fc->connect();
		$sql = "
			UPDATE `listener` SET status = 3, del = 1, moderatedTime = '".time()."' WHERE id = '$id'
		";
		
		$result = $dbh->exec($sql);
		if ($result === false) {
			echo ('ERROR');
		}
	}
	public function getNewMsg () {
		$fc = FrontController::getInstance();
		$dbh = $fc->connect();
		//json
		
		$arr = array("newAnswer"=>array(),"newMsg"=>array(),"del"=>array());
		//Получаем последнее сообщение на которое ответил докладчик
		$sql = "
			SELECT id,listenerName,listenerTitle,listenerMsg,status,reporterAnswer,createTime,answeredTime
				FROM `listener` 
					WHERE answeredTime = (SELECT MAX(answeredTime) FROM `listener`) AND status = 1
		";
		$sth = $dbh->prepare($sql);
		$sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		if ($result) {
			foreach ($result[0] as $key=>$item) {
				$arr["newAnswer"]["$key"] = $item;
			}
		}
		//Получаем последнее созданное сообщение слушателем
		$sql = "
			SELECT id,listenerName,listenerTitle,listenerMsg,status,createTime
				FROM `listener` 
					WHERE createTime = (SELECT MAX(createTime) FROM `listener`) AND status = 0
		";
		$sth = $dbh->prepare($sql);
		$sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		if ($result) {
			foreach ($result[0] as $key=>$item) {
				$arr["newMsg"]["$key"] = $item;
			}
		}
		//Получаем все сообщения у которых del = 1 и answeredTime = 0 (принятые и с ответом докладчика)
		$sql = "
			SELECT id
				FROM `listener` 
					WHERE del = 1 AND answeredTime = 0
		";
		$sth = $dbh->prepare($sql);
		$sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		foreach ($result as $items) {
			foreach ($items as $key=>$item ) {
				$arr["del"][]["$key"] = $item;
			}
		}
		echo json_encode ($arr);	
	}
}