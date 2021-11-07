<?php
/**
 * Git webhooks 自动部署脚本
 * 地址：https://github.com/fuzhengwei/guide-webhooks/settings/hooks
 */

exec("cd ~ && cd - && cd -", $output);
print_r($output);

// 接收post参数
$requestBody = file_get_contents("php://input");
if (empty($requestBody)) {
    exit('data null！');
}
$content = json_decode($requestBody, true);

// 验证密码,验证码云上配置的webhook密码
//if (empty($content['password']) || $content['password'] != 'password') //{
//	exit('password error');
//}

$path = "/www/wwwroot/39.96.73.167/guide-webhooks/"; //项目存放物理路径

//判断master分支上是否有提交
if ($content['ref'] == 'refs/heads/main') {

    $res = shell_exec("cd {$path} && git pull origin main 2>&1"); // 当前为www用户

    $res_log = '------------------------->' . PHP_EOL;
    $res_log .= '用户' . $content['user_name'] . ' 于' . date('Y-m-d H:i:s') . '向' . $content['repository']['name'] . '项目的' . $content['ref'] . '分支push了' . $content['total_commits_count'] . '个commit：' . PHP_EOL;
    $res_log .= $res . PHP_EOL;

    $x = file_put_contents("git_webhook_log.txt", $res_log, FILE_APPEND);//追加写入日志文件

    if ($x) {
        echo 'true-';
    } else {
        echo 'false-';
    }
}
echo 'done';

