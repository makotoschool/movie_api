<?php
// ファイルからJSONを読み込み
$json = file_get_contents("https://api.themoviedb.org/3/search/movie?api_key=002e50c7a2505b32c630b7bd2f07b82b&query=a%");

// 文字化けするかもしれないのでUTF-8に変換
$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
// オブジェクト毎にパース
// trueを付けると連想配列として分解して格納してくれます。
$obj = json_decode($json, true);
 
// パースに失敗した時は処理終了
if ($obj === NULL) {
return;
}

echo '<pre>';
print_r($obj);
echo '</pre>';
