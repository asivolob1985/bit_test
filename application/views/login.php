Данные пользователя:

<p>ЛОГИН: <?=$user['login']?></p>
<p>БАЛАНС: <?=$user['balance']?> руб.</p>


<? if($user['balance'] > 0):?>
	<a href="/withdraw"><button class="btn btn-default">Вывести деньги</button></a>
<? endif?>
<a href="/auth/logout"><button class="btn btn-info">Выйти</button></a>


