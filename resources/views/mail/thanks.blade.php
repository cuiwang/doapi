尊敬的 {{base64_decode($user->name)}} , 请点击下面的链接,激活您的大神身份:<hr> <a href="{{ url('/verify/'.$user->confirm_code) }}"> 大神,请使劲戳我! </a><hr><p style="margin-top: 50px">请不要回复此邮件!</p>
