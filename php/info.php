<?php
$fp = fopen("info-2.text", "r"); // ファイルをひらく
$line = array(); // ファイル内容を1行1行要素に格納する配列
                 // ファイルが正しく開けたとき
if ($fp) {
    while (! feof($fp)) {
        $line[] = fgets($fp);
    }
    fclose($fp);
}
?>
<!doctype html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>テニスサークル交流サイト</title>
</head>
<body>
	<h1>テニスサークル交流サイト</h1>
	<p>
		<a href="index.php">トップページに戻る</a>
	</p>
	<h2>お知らせ</h2>
<?php
if (count($line > 0)) {
    for ($i = 0; $i < count($line); $i ++) {
        if ($i == 0) { // 初めの行はタイトル
            echo '<h3>' . $line[0] . '</h3>';
        } else {
            echo $line[$i] . '<br>';
        }
    }
} else {
    // ファイルの中身が空だったとき
    echo '_お知らせはありません。';
}
?>
</body>
</html>