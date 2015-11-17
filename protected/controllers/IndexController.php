<?php
class IndexController implements IController {
	public function indexAction() {
		$fc = FrontController::getInstance();
		/* Инициализация модели */
		$model = new FileModel();
		$view = 'listener.php';
		$file = './protected/views/layout/main.php';
		$output = $model->render($file,$view);
		
		$fc->setBody($output);
	}
	public function sendAction() {
		//принимаем POST с sendRequest(), фильтруем и отдаем модели, сохраняем данные в БД
		$fc = FrontController::getInstance();
		$arr = array();
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$arr['listenerName'] = $fc->clearData($_POST['name']);
			$arr['listenerTitle'] = $fc->clearData($_POST['title']);
			$arr['listenerMsg'] = $fc->clearData($_POST['msg']);
		}
		
		$model = new ListenerModel();
		$model->saveData($arr);
	}
}
