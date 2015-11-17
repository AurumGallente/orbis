<?php
class StatisticModel {
	public function showAll() {
		
		$fc = FrontController::getInstance();
		$dbh = $fc->connect();
		$sql = "
			SELECT listenerName, listenerTitle, status, moderatedTime
				FROM listener 
					ORDER by moderatedTime
		";
		$sth = $dbh->prepare($sql);
		$sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		foreach ($result as $item) {
			switch ($item['status']) {
				case 0: $status="На модерации";break;
				case 1: $status="<span class='text-success'>Одобрено</span>";break;
				case 2: $status="<span class='text-danger'>Отклонено</span>";break;
				case 3: $status="<span class='text-info'>В архиве</span>";break;
			}
			echo "<tr>
					<td>$item[listenerName]</td>
					<td>$item[listenerTitle]</td>
					<td>$status</td>
					<td>";
			echo ($item[moderatedTime] != 0) ? date("d-m-Y H:i:s",$item[moderatedTime]) : "";
			echo	"</td>
				</tr>";
		}
	}
}