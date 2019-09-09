<?php
//データの受け取り
$name = $_POST["name"];
$title = $_POST["title"];
$body = $_POST["body"];
$pass = $_POST["pass"];

//必須項目チェック(名前が空ではないか？)
if($name == '' || $body == ''){
    header('Location: bbs.php');//bbs.phpへ移動
    exit();//終了
}
//必須項目チェック(パスワードは4桁の数字か？)
if(!preg_match("/^[0-9]{4}$/",$pass)){
    header ('Location: bbs.php');
    exit();
}
//名前をクッキーにセット
setcookie('name',$name, time()+60 *60*24*30);

//データベースに接続
$dsn = 'mysql:host=localhost;dbname=tennis;charset=utf8';
$user = 'tennisuser';
$password = 'password';

try {
    $db = new PDO($dsn,$user,$password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    //プリペアードステートメントを作成
    $stmt = $db->prepare("
        INSERT INTO bbs (name,title,body,date,pass)
        VALUES (:name, :title, :body, :now(), :pass)"
        );
    //パラメーターを割り当て
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':body',$body, PDO::PARAM_STR);
    $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
//クエリの実行
$stmt->excute();

//bbs.phpに戻る
header('Location: bbs.php');
} catch (Exception $e) {
    echo ('エラー:'. $e->getmessage());
}
?>