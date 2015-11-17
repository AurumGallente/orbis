function sendRequest () {
	//принимаем данные из формы listener.php, формируем searchString
	var name = document.getElementById("name").value;
	var title = document.getElementById("title").value;
	var msg = document.getElementById("msg").value;
	var searchString = "name=" + encodeURIComponent(name) + "&" + "title=" + encodeURIComponent(title) + "&" + "msg=" + encodeURIComponent(msg);
	// Запрос к серверу
	var req = getXmlHttpRequest();
	req.onreadystatechange = function()
		{
			if (req.readyState != 4) return;
			
			//Оповещение об отправке сообщения
			showPopup();
		}
	// Метод POST
	req.open("POST", "/index/send", true);

	// Установка заголовков
	req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	
	// Отправка данных POST`ом котролеру IndexController, sendAction
	req.send(searchString);
}
function showPopup () {
	$(":input").val("");
	$("#listenerSend").modal();
	
}