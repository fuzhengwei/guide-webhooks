<?php
header('Content-type: text/html; charset=utf-8');
ini_set("error_reporting", "E_ALL & ~E_NOTICE");

echo "Hi，HelloWorld！By 小傅哥";

echo "\r\n输出账户地址：\r\n";



exec("cd ~ && cd - && cd -", $output);
print_r($output);