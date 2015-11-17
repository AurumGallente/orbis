$(document).ready(function(){
	$("textarea").focusin(function (){
		var div = $(this).parents('div .msg-box');
		div.addClass('selected-div');
		div.focusout(function() {
			$(this).removeClass('selected-div');
		});
	});
	$("button").on("click",function(){
		//Принимаем значения textarea
		var answer = $(this).siblings().find('textarea').val();
		//Определяем id дива к которому относится нажатая кнопка
		var div = $(this).parents('div .row');
		var id = div.attr('id');
		
		//Формируем строку запроса
		var queryString = "id=" + encodeURIComponent(id) + "&" + "answer=" + encodeURIComponent(answer);
		var req = getXmlHttpRequest();
		req.onreadystatechange = function()
			{
				if (req.readyState != 4) return;
				
				//Удаляем div сообщения на который ответил докладчик со страницы
				div.detach();
			}
		// Метод POST
		req.open("POST", "/reporter/send", true);

		// Установка заголовков
		req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		
		// Отправка данных контролеру ModeratorController методу sendAction
		req.send(queryString);	
		
	});
});