<?php
$fp= fopen("info-2.text", "r"); //ファイルを開く
?>
<!doctype html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>テニスサークル交流サイト</title>
</head>
<body>
<h1>テニスサークル交流サイト</h1>
<p><a href="album.php">アルバム</a></p>
<p><a href="bbs.php">掲示板</a></p>
<h2>お知らせ</h2>
<?php
//ファイルが正しく開けたとき
if($fp){
    $title=fgets($fp);//ファイルから1行読み込む
    //行読み込めたとき
    if ($title){
        echo '<a href="info.php">' . $title . '</a>';

    }else {
        //ファイルの中身が空だった時
        echo 'おしらせはありません。';
    }
    fclose($fp); //ファイルを閉じる
}else{
    //ファイルが開けなかったとき
    echo 'お知らせはありません。';
}
?>
</body>
</html>