<?php
class FrontController extends config {
	protected $_controller, $_action, $_params, $_body;
	static $_instance;
	private $db_connect;
	public static function getInstance() {
		if(!(self::$_instance instanceof self)) 
			self::$_instance = new self();
		return self::$_instance;
	}
	private function __construct(){
		$request = $_SERVER['REQUEST_URI'];
		$splits = explode('/', trim($request,'/'));
		//Определение controller
		$this->_controller = !empty($splits[0]) ? ucfirst($splits[0]).'Controller' : 'IndexController';
		//Определение action
		$this->_action = !empty($splits[1]) ? $splits[1].'Action' : 'indexAction';
		//Получение параметров
		if(!empty($splits[2])){
			$keys = $values = array();
				for($i=2, $cnt = count($splits); $i<$cnt; $i++){
					if($i % 2 == 0){
						//Чётное = ключ (параметр)
						$keys[] = $splits[$i];
					}else{
						//Значение параметра;
						$values[] = $splits[$i];
					}
				}
			$this->_params = array_combine($keys, $values);
		}
	}
	public function route() {
		if(class_exists($this->getController())) {
			$rc = new ReflectionClass($this->getController());
			if($rc->implementsInterface('IController')) {
				if($rc->hasMethod($this->getAction())) {
					$controller = $rc->newInstance();
					$method = $rc->getMethod($this->getAction());
					$method->invoke($controller);
				} else {
					throw new Exception("Action");
				}
			} else {
				throw new Exception("Interface");
			}
		} else {
			throw new Exception("Controller");
		}
	}
	//Обрабатываем данные из формы перед сохранением в базу
	public function clearData($data,$type = 'string') {
		switch ($type) {
			case 'string' : return trim(strip_tags($data));break;
			case 'int' : return (int) $data;break;
		}
	}
	//Подключение к базе
	public function connect () {
        if(isset($this->db_connect)){
            return $this->db_connect;
        }
        else {
            $dsn = $this->dsn;
            $user = $this->user;
            $password = $this->password;
            try {
                $this->db_connect = new PDO($dsn, $user, $password);
                return $this->db_connect;
            } catch (PDOException $e) {
                echo 'Подключение не удалось: ' . $e->getMessage();
            }
        }
	}
	public function getParams() {
		return $this->_params;
	}
	public function getController() {
		return $this->_controller;
	}
	public function getAction() {
		return $this->_action;
	}
	public function getBody() {
		return $this->_body;
	}
	public function setBody($body) {
		$this->_body = $body;
	}
}	