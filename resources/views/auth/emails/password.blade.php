请点击下面的链接,修改您的密码:<hr> <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a><hr><p>请不要将本邮件转发给其他人!</p>
