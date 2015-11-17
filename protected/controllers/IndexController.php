<?php
class IndexController implements IController {
	public function indexAction() {
		$fc = FrontController::getInstance();
		/* ������������� ������ */
		$model = new FileModel();
		$view = 'listener.php';
		$file = './protected/views/layout/main.php';
		$output = $model->render($file,$view);
		
		$fc->setBody($output);
	}
	public function sendAction() {
		//��������� POST � sendRequest(), ��������� � ������ ������, ��������� ������ � ��
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
