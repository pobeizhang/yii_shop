<p>尊敬的<?php echo $adminuser?>，您好:</p>
<p>你的找回密码的链接如下：</p>
<?php $url = Yii::$app->urlManager->createAbsoluteUrl(['admin/manage/mailchangepass', 'timestamp' => $time, 'adminuser' => $adminuser, 'token' => $token]);?>
<p><a href="<?php echo $url;?>"><?php echo $url;?></a></p>
<p>该链接将在5分钟后失效，请尽快完成操作!!!为确保你的账号安全，请勿泄露此链接!!!</p>
<p>该邮件为系统自动发送，请勿回复此邮件...</p>