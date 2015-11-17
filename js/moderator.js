$(document).ready(function(){
	
	setInterval(function(){
		//console.log(divIdDel);
		var req = getXmlHttpRequest();
		req.onreadystatechange = function()
			{
				if (req.readyState != 4) return;
				//console.log(div);
				var json = eval( '('+req.responseText+')' );
				//console.log("fromModel "+req.responseText);
				var toPrepend ="";
				
				//отрисовываем новое сообщение
				if (!$.isEmptyObject(json.newMsg)) {
					var newM = $("div #"+json.newMsg.id).attr('id');
					if (typeof newM == "undefined") {
						toPrepend += "<div class='row' id='"+json.newMsg.id+"'>";
						toPrepend +="<div class='col-lg-8'><div class='msg-box'>";
						toPrepend +="<p>Слушатель: "+json.newMsg.listenerName+" <small class='pull-right'><i>";
						toPrepend += date("d-m-Y H:i:s",json.newMsg.createTime);
						toPrepend += "</i></small></p>";
						toPrepend +="<p>Статус: "+json.newMsg.status+"</p>";
						toPrepend +="<h4>"+json.newMsg.listenerTitle+"</h4>";
						toPrepend +="<p>"+json.newMsg.listenerMsg+"</p>";
						toPrepend +="<button type='button' class='btn btn-success approve'>Принять</button> ";
						toPrepend +="<button type='button' class='btn btn-danger deny'>Отклонить</button> ";
						toPrepend +="<button type='button' class='btn btn-info archiv' disabled='disabled'>В архив</button>";
						toPrepend +="</div></div></div>";
						$('#main').append(toPrepend);
						toPrepend ="";
					}
				}
				//отрисовываем ответ докладчика
				
				if (!$.isEmptyObject(json.newAnswer)) {
					var newA = $("div #"+json.newAnswer.id).attr('id');
					if (typeof newA == "undefined") {
						toPrepend += "<div class='row' id='"+json.newAnswer.id+"'>";
						toPrepend += "<div class='col-lg-8'><div class='msg-box'>";
						toPrepend += "<p>Слушатель: "+json.newAnswer.listenerName+" <small class='pull-right'><i>";
						toPrepend += date("d-m-Y H:i:s",json.newAnswer.createTime);
						toPrepend += "</i></small></p>";
						toPrepend += "<p>Статус: "+json.newAnswer.status+"</p>";
						toPrepend += "<h4>"+json.newAnswer.listenerTitle+"</h4>";
						toPrepend += "<p>"+json.newAnswer.listenerMsg+"</p>";
						toPrepend += "<button type='button' class='btn btn-success approve' disabled='disabled'>Принять</button> ";
						toPrepend += "<button type='button' class='btn btn-danger deny'>Отклонить</button> ";
						toPrepend += "<button type='button' class='btn btn-info archiv'>В архив</button>";
						toPrepend += "</div></div>";
						toPrepend += "<div class='col-lg-4'>";
						toPrepend += "<p><small class='pull-right'><i>";
						toPrepend += date("d-m-Y H:i:s",json.newAnswer.answeredTime);
						toPrepend += "</i></small><br />"+json.newAnswer.reporterAnswer+"</p>";
						toPrepend += "</div></div>";
						$('#main').append(toPrepend);
						toPrepend ="";
					}
				}
				
				//убираем со страницы все сообщения у которых del = 1 и answeredTime = 0 (принятые и с ответом докладчика)
				if (!$.isEmptyObject(json.del)) {
					for (var i=0;i < json.del.length;i++) {
						if ($("div #"+json.del[i].id)) {
							$("div #"+json.del[i].id).detach();
							
						}
					}
				
				}
				
			}
		req.open("GET", "/moderator/newmsg", true);
		
		req.send();
	},4000); 
	
	$("button").on("click",function(){
		//Определяем class нажатой кнопки
		if ($(this).hasClass('approve')){
			var clas = "approve";
		}else if ($(this).hasClass('deny')){
			var clas = "deny";
		}else {
			var clas = "archiv";
		}
		//Определяем id дива к которому относится нажатая кнопка
		var div = $(this).parents('div .row');
		var id = div.attr('id');
		//Формируем строку запроса
		var queryString = "id=" + encodeURIComponent(id) + "&" + "class=" + encodeURIComponent(clas);
		var req = getXmlHttpRequest();
		req.onreadystatechange = function()
			{
				if (req.readyState != 4) return;
				//Удаляем div сообщения который прошел модерацию со страницы
				div.detach();
				
			}
		// Метод POST
		req.open("POST", "/moderator/send", true);

		// Установка заголовков
		req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		
		// Отправка данных контролеру ModeratorController методу sendAction
		req.send(queryString);
		
	});
	
});
