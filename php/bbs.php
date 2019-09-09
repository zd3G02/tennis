<?php
    //1ページに表示されるコメントの数
    $num = 10;

    //データベースに接続
    $dsn = 'mysql:host=localhost;dbname=tennis;charset=utf8';
    $user = 'tennisuser';
    $password = 'password';

    //ページが指定されているとき
    $page = 0;
    if(isset($_GET['page']) && $_GET['page'] > 0 ) {
        $page = intval($_GET['page']) -1;
    }

    try {
        $db =new PDO($dsn,$user,$password);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        //プリペアードステートメントを作成
        $stmt = $db->prepare(
            "SELECT * FROM bbs ORDER BY date DESC LIMIT
            :page, :num");
        //パラメータを割り当て
        $page = $page * $num;
        $stmt->bindParam(':page',$page, PDO::PARAM_INT);
        $stmt->bindParam(':num', $num, PDO::PARAM_INT );
        //クエリの実行
        $stmt->execute();
    } catch (Exception $e) {
        echo "エラー:" . $e->getMessage();
    }
?>
<!doctype html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>掲示板</title>
</head>
<body>
	<h1>掲示板</h1>
	<p>
		<a href="index.php">トップページに戻る</a>
	</p>
	<form action="write.php" method="post">
		<p>
			名前：<input type="text" name="name"
			value="<?php echo $_COOKIE['name']?>">
		</p>
		<p>
			タイトル：<input type="text" name="title">
		</p>
		<textarea name="body"></textarea>
		<p>
			削除パスワード(数字4桁) : <input type="text" name="pass">
		</p>
		<p>
			<input type="submit" value="書き込む">
		</p>
	</form>
	<hr />
	<?php
	while ($row = $stmt->fetch()):
	    $title = $row['title'] ? $row['title'] : '(無題)';

    ?>
    <p>名前:<?php echo $row['name']?></p>
    <p>タイトル:<?php echo $title?></p>
    <p><?php echo nl2br($row['body'], false) ?></p>
    <p><?php echo $row['date']?></p>
	<?php endwhile;

	//ページ数の表示
	try {
	    //プリペアードステートメントを作成
	    $stmt = $db->prepare("SELECT COUNT(*) FROM bbs");
	    //クエリの実行
	    $stmt->execute();
	    } catch (Exception $e) {
	        echo "エラー :" .$e->getMessage();
	}

	//コメントの件数を取得
	$comments = $stmt->fetchColumn();
	//ページ数を計算
	$max_page = ceil($comments / $num);
	echo '</p>';
	for($i = 1; $i <= $max_page; $i++){
	    echo '<a href="bbs.php?page=' . $i . '">' . $i .
	    '</a>&nbsp;';
	}
	echo '</p>';
	?>
</body>
</html>

