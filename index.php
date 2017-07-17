<?php
echo "hello world";

$hoge = "my name is hoge";
echo $hoge;

// 配列の作成

$h_array = array(1, 2, 3, 4);
echo $h_array[0];

// 連想配列(map的なやつ)
$foo = array(
    "山田" => 1,
    "太郎" => 3,
    "その他" => 10,
);

foreach ($h_array as $key => $value) {
    # code...
    echo "$key $value";
}
foreach ($foo as $key => $value) {
    # code...
    echo "$key $value";
}
 ?>
