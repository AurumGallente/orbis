<script type="text/javascript" src="http://orbis/js/sendlistener.js"></script>
<div class="row">
	<div class="col-lg-8">
		<form onsubmit="return false">
			<p><input type="text" name="listenerName" id="name" placeholder="Введите ваше имя"/></p>
			<p><input type="text" name="listenerTitle" id="title" placeholder="Тема сообщения"/></p>
			<p><textarea name="listenerMsg" id="msg" placeholder="Введите ваше сообщение" cols="60" rows="5"></textarea></p>
			<p><button class="btn btn-success" onclick="sendRequest()">Отправить</button></p>
		</form>
	</div>
</div>
<div class="modal fade" id="listenerSend" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h4 id="myModalLabel">Сообщение отправлено</h4>
	  </div>
	  <div class="modal-body">
		<p>Ваше сообщение отправлено на модерацию</p>
	  </div>
    </div>
  </div>
</div>