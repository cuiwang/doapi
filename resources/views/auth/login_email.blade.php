@extends('common.base_user')
@section('title','Do API - 邮箱登录')
@section('user_stylesheets')
@parent
		<!--USER STYLESHEETS -->
<link rel="stylesheet" href="{{asset('css/user_register.css?v=1')}}">
<link href="{{asset('assets/js/iCheck/flat/all.css')}}" rel="stylesheet">
@endsection


@section('user_content')
	<section id="login">
<div class="container">
		<div class="col-md-12">
			<h1 class="margin-bottom-30">欢迎您的登录</h1>
			<form class="form-horizontal templatemo-container templatemo-login-form-1 margin-bottom-30" role="form" action="{{url('login')}}" method="post">
				{{ csrf_field() }}
		         <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
		          <div class="col-xs-12">		            
		            <div class="control-wrapper">
		            	<label for="email" class="control-label fa-label"><i class="fa fa-envelope-o"></i></label>
		            	<input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="您注册时所用的邮箱地址">
						@if ($errors->has('email'))
							<span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
						@endif
		            </div>		            	            
		          </div>              
		        </div>
		        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
		          <div class="col-md-12">
		          	<div class="control-wrapper">
		            	<label for="password" class="control-label fa-label"><i class="fa fa-key"></i></label>
		            	<input  id="password" type="password" class="form-control" id="password" name="password" placeholder="密码">
						@if ($errors->has('password'))
							<span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
						@endif
		            </div>
		          </div>
		        </div>

				<div class="form-group">
					<div class="col-md-12">
						<div class="control-wrapper">
						<div class="skin-flat col-md-1">
							<input type="checkbox" checked id="remember" name="remember">
						</div>
							<div class="col-md-9">
								<p style="color: #666">记住我 <span style="color: #999;font-size: 12px">*选中后,存储登录信息,直到主动退出</span></p>
							</div>
						</div>
					</div>
				</div>

		        <div class="form-group">
		          <div class="col-md-12">
		          	<div class="control-wrapper text-center">
		          		<input id="login_btn" style="width: 300px;background-color: #ec7063;color: white" type="submit" value="登录" class="btn btn-default">
						<a class="btn btn-link" href="{{ url('/password/reset') }}">忘记密码?</a>
		          	</div>
		          </div>
		        </div>
		      </form>
		     
		</div>

	<div class="text-center">
		<a href="{{url('register')}}" class="user-create-new">立即注册</a>  <a href="{{url('login')}}" class="user-create-new">或 QQ,微信,微博帐号登录 <i class="fa fa-chevron-right"></i></a>
	</div>
	</div>
</section>
	@endsection

@section('user_script')
	@parent
	<script type="text/javascript" src="{{asset('assets/js/iCheck/jquery.icheck.js')}}"></script>
	<script type="text/javascript" src="js/jquery.cookie.js"></script>
	<script>
		$(document).ready(function() {
//			$.cookie('email', null);
			//CHECKBOX PRETTYFY
			$('.skin-flat input').iCheck({
				checkboxClass: 'icheckbox_flat-red',
				radioClass: 'iradio_flat-red'
			});
			if ($.cookie('email') && $.cookie('email') != 'null') {
				$("#email")[0].value = $.cookie('email');
			}
			if ($.cookie('password') && $.cookie('password') != 'null') {
				$("#password")[0].value = $.cookie('password');
			}

		});
	</script>
	<script >
		$('#login_btn').on('click', function(){
			$.cookie('email',  $("#email")[0].value, { expires: 30 }); // 存储一个带30天期限的 cookie
			$.cookie('password',  $("#password")[0].value, { expires: 30 }); // 存储一个带30天期限的 cookie
			layer.msg('正在载入..', {icon: 16,shade: 0.3,time: 25000});
		});
	</script>
@endsection