<?php
class ReporterController implements IController {
	public function indexAction() {
		$fc = FrontController::getInstance();
		/* Инициализация модели */
		$model = new FileModel();
		$view = 'reporter.php';
		$file = './protected/views/layout/main.php';
		$output = $model->render($file,$view);
		
		$fc->setBody($output);
	}
	public function sendAction () {
		//принимаем id дива и тело сообщения, отправляем ReporterModel
		$fc = FrontController::getInstance();
		if ($_SERVER['REQUEST_METHOD']=='POST'){
			$id = $fc->clearData($_POST['id'],'int');
			$data = $fc->clearData($_POST['answer']);
		}
		
		$model = new ReporterModel();
		$model->saveData($id,$data);
	}
}
