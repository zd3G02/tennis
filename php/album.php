<?php
 $images= array();//画像ファイル名のリストを格納する配列
 $num=5;//1ページに表示する画像の枚数

 //画像フォルダから画像ファイル名を読み込む
 if ($handle = opendir('./album')){
     while($entry = readdir($handle)){
         //「.」および「..」でないとき、ファイル名を配列に追加
         if($entry != "." && $entry != ".."){
             $images[] = $entry;
         }
 }
 closedir($handle);
 }
 ?>
 <!doctype html>
 <html lang="ja">
 <head>
 	<meta charset="UTF-8">
 	<title>交流サイト:アルバム</title>
 </head>
 <body>
 <h1>交流サイト:アルバム</h1>
 <p>
 <a href="index.php">トップページに戻る</a>
 <a href="upload.php">写真をアップロードする</a>
 </p>
 <?php
 if (count($images)>0){
     //指定枚数ごとに画像ファイル名を分割
     $images= array_chunk($images, $num);
     //ページ数指定、基本は０ページ目を指す
     $page =0;
     //GETでページ数が指定されていた場合
     if(isset($_GET['page']) && is_numeric($_GET['page'])){
         $page=intval($_GET['page']) - 1;
         if (!isset($images[$page])){
             $page=0;
         }
     }

     //画像の表示
     foreach($images[$page] as $img){
         echo '<img src="./album/' . $img . '">';
     }
     //ページ数リンク
     echo '<p>';
     for ($i =1; $i<= count($images);$i++){
         echo '<a href="album.php?page=' . $i .
         '">'. $i. '</a>&nbsp;';
     }
     echo '</p>';
 }else{
     echo '<p>画像はまだありません</p>';
 }
 ?>
 </body>
 </html>