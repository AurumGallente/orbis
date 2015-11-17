<?php
class StatisticController implements IController {
	public function indexAction() {
		$fc = FrontController::getInstance();
		/* Инициализация модели */
		$model = new FileModel();
		$view = 'statistic.php';
		$file = './protected/views/layout/main.php';
		$output = $model->render($file,$view);
		
		$fc->setBody($output);
	}	
}
