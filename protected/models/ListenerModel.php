<?php
class ListenerModel{
	
	public function saveData ($arr) {
		//сохраняем данные из формы listener.php в БД, добавляем status и createTime
		$time = time();
		$sql = "
			INSERT INTO listener (
								listenerName,
								listenerTitle,
								listenerMsg,
								status,
								createTime)
						VALUES (
								'$arr[listenerName]',
								'$arr[listenerTitle]',
								'$arr[listenerMsg]',
								0,
								$time)
		";
		//echo $sql;
		$fc = FrontController::getInstance();
		$dbh = $fc->connect();
		//var_dump ($fc->connect());
		$result = $dbh->exec($sql);
		
		if ($result === false) {
			echo ('ERROR');
		}
	}
}