<?php

class ModeratorController implements IController {
	
	public function indexAction() {
		$fc = FrontController::getInstance();
		/* Инициализация модели */
		$model = new FileModel();
		$view = 'moderator.php';
		$file = './protected/views/layout/main.php';
		$output = $model->render($file,$view);
		
		$fc->setBody($output);
	}
	//Обновление статуса сообщения
	public function sendAction () {
		//принимаем id дива сообщения и класс нажатой кнопки, отправляем ModeratorModel
		$fc = FrontController::getInstance();
		if ($_SERVER['REQUEST_METHOD']=='POST'){
			$id = $fc->clearData($_POST['id'],'int');
			$class = $fc->clearData($_POST['class']);
		}
		$model = new ModeratorModel();
		$model->getParams($id,$class);
	}
	
	public function newmsgAction () {
		$fc = FrontController::getInstance();
		$model = new ModeratorModel();
		$model->getNewMsg();
	}
}
