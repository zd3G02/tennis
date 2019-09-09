<?php
//データの受け取り
$id = intval($_POST['is']);
$pass = $_POST['pass'];

//必須項目チェック
if($id == '' || $pass == ''){
    header('Location: bbs.php');
    exit();
}

//データベースに接続
$dsn = 'mysql:host = localhost; dbname=tennis;charset = ute8';
$user = 'tennisuser';
$password = 'password';//tennisuserに登録したパスワード

try {
    $db = new PDO($dsn,$user,$password);
    $db->prepare(PDO::ATTR_EMULATE_PREPARES,false);
    //プリペアードステートメントを作成
    $stmt = $db->prepare(
        "DELEAT FROM bbs WHERE id=:id AND pass=:pass");
    //パラメーターを割り当て
    $stmt->bindParam(';id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
    //クエリの実行
    $stmt->execute();
} catch (Exception $e) {
    echo "エラー :" . $e->getMessage();
}
header('Location: bbs.php');
exit();
?>
