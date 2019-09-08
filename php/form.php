<?php
$name=$_POST["name"];
$id=$_POST["id"];
$adress=$_POST["adress"];
$type=$_POST["type"];
echo $name;
echo $id;
echo $adress;
echo $type;


?>
<!doctype html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<form action="" method="post">
<p>名前を入力して下さい:<input type="text" name="name"  placeholder="山田太郎" required="true"></p>
<p>IDを入力して下さい:<input type="text"  name="id"  required="true" ></p>
<p><select name="adress" >
<option value="" >選択してください</option>
<option value="東京" selected >東京</option>
<option value="千葉">千葉</option>
<option value="埼玉">埼玉</option>
<option value="神奈川">神奈川</option>
</select></p>
<input type="radio" name="type" value="男性" checked>男性
<input type="radio" name="type" value="女性">女性
<p><input type="submit" value="送信"></p>
</form>
</body>
</html>