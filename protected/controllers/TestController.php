<?php
class TestController implements IController  {
	public function indexAction() {
		$fc = FrontController::getInstance();
		//echo 1;
		var_dump($_POST);
	}
}
?>