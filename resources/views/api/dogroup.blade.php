@extends('common.base_layout')
@section('title','Do API - 新建分类')
@section('stylesheet')
	<link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	{{--	<link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">--}}
	<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/loader-style.css')}}">

	<!--custom风格-->
	<link rel="stylesheet" href="{{asset('assets/css/extra-pages.css')}}">

	<link href="{{asset('assets/js/iCheck/flat/all.css')}}" rel="stylesheet">

	@endsection
@section('content')
	<div class="wrap-fluid">
		<div class="container-fluid paper-wrap bevel tlbr">

			<!-- CONTENT -->
			<!-- BREADCRUMB -->
			<ul id="breadcrumb">
				<li>
					<span class="entypo-home"></span>
				</li>
				<li><i class="fa fa-lg fa-angle-right"></i>
				</li>
				<li><a href="#" title="Sample page 1">新建分类</a>
				</li>
			</ul>
			<!-- END OF BREADCRUMB -->

			<!--说明-->
			<div class="content-wrap">
				<div class="row">

				</div>
			</div>
			<!--说明结束-->
			<!-- 创建步骤-->
			<div class="content-wrap">
				<div class="time-wrap">
					<div class="row">
						<div class="col-md-12">
							<!-- The time line -->
							<ul class="timeline">
								<!-- timeline time label -->
								<li class="time-label">
										<span class="bg-red">
                                        准备制作了
                                    </span>
									<div class="timeline-item">
										<div class="timeline-body">
											<h4>Base URL: http://www.do-api.com/cuiwang/weixin/</h4>
										</div>
									</div>
								</li>
								<!-- /.timeline-label -->
								<!-- 分类信息 -->
								<li>
									<i class="fa  bg-time">1</i>
									<div class="timeline-item">
										<!--<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>-->
										<h4 class="timeline-header"><a href="#">1.分类信息</a> (实际地址 = Base URL + 分类名称)</h4>
										<div class="timeline-body">
											<!--<div class="well">
                                                <h5>请填写分类名称和说明,名称请用字母填写.</h5>
                                            </div>-->
											<div>
												<form action="contact" id="contact-form" class="form-horizontal">
													<fieldset>
														<div class="control-group">
															<label style="margin-bottom: 5px;" class="control-label" for="name">分类名称: *</label>
															<div class="controls">
																<input type="text" class="form-control" name="name" id="name" placeholder="例如: userinfo" onkeyup="changeValue(this.value)">
															</div>
														</div>
														<div class="control-group" style="margin:10px 0;">
															<label style="margin-bottom: 5px;" class="control-label" for="message">分类介绍: *</label>
															<div class="controls">
																<input type="text" class="form-control" name="message" id="message" placeholder="例如: 用户信息类">
															</div>
														</div>

														<div class="control-group">
															<label style="margin-bottom: 5px;" class="control-label" for="name">分类地址: (自动生成,不可编辑)</label>
															<div class="controls" style="margin-bottom: 10px;">
																<!-- /btn-group -->
																<input type="text" class="form-control" placeholder="http://www.do-api.com/cuiwang/weixin/" disabled="disabled" id="weburl">
															</div>
														</div>

													</fieldset>
												</form>

											</div>

										</div>
									</div>
								</li>
								<!-- END 分类信息 -->

								<!-- 接口选择 -->
								<li>
									<i class="fa  bg-time">2</i>
									<div class="timeline-item">
										<!--<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>-->
										<h4 class="timeline-header"><a href="#">2.接口选择</a> (请至少选择1个接口放入分类)</h4>

										<div class="timeline-body">
											<!--<div class="well">
                                                <h5>接口不能存在于多个分类中.</h5>
                                            </div>-->
											<div class="row" style="margin-top: 10px;margin-bottom: -20px;">
												<!--content-->
												<div class="col-sm-3">
													<ul class="list">
														<li>
															<input tabindex="1" type="checkbox" id="line-checkbox-1">
															<label>login.acthion</label>
														</li>
													</ul>

												</div>
												<div class="col-sm-3">
													<ul class="list">
														<li>
															<input tabindex="2" type="checkbox" id="line-checkbox-1">
															<label>login.acthion</label>
														</li>
													</ul>

												</div>
												<div class="col-sm-3">
													<ul class="list">
														<li>
															<input tabindex="3" type="checkbox" id="line-checkbox-1">
															<label>login.acthion</label>
														</li>
													</ul>

												</div>
												<div class="col-sm-3">
													<ul class="list">
														<li>
															<input tabindex="4" type="checkbox" id="line-checkbox-1">
															<label>login.acthion</label>
														</li>
													</ul>

												</div>

												<!--end content-->
											</div>
											<div class="row" style="margin-top: 10px;margin-bottom: -20px;">
												<!--content-->
												<div class="col-sm-3">
													<ul class="list">
														<li>
															<input tabindex="1" type="checkbox" id="line-checkbox-1">
															<label>login.acthion</label>
														</li>
													</ul>

												</div>
												<div class="col-sm-3">
													<ul class="list">
														<li>
															<input tabindex="2" type="checkbox" id="line-checkbox-1">
															<label>login.acthion</label>
														</li>
													</ul>

												</div>
												<div class="col-sm-3">
													<ul class="list">
														<li>
															<input tabindex="3" type="checkbox" id="line-checkbox-1">
															<label>login.acthion</label>
														</li>
													</ul>

												</div>
												<div class="col-sm-3">
													<ul class="list">
														<li>
															<input tabindex="4" type="checkbox" id="line-checkbox-1">
															<label>login.acthion</label>
														</li>
													</ul>

												</div>

												<!--end content-->
											</div>

										</div>
									</div>
								</li>
								<!-- END 接口选择 -->
								<li>
									<div class="timeline-item">
										<div class='timeline-footer'>
											<a class="btn btn-info btn-flat btn-xs">提交制作 <span class="fa fa-check"></span></a>
										</div>
									</div>
								</li>
								<li>
									<i class="fa fa-check bg-time"></i>
								</li>
							</ul>
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
				</div>
			</div>
			<!--创建步骤结束-->

			<!-- /END OF CONTENT -->
		</div>
	</div>
@endsection

@section('javascript')
		<!-- MAIN EFFECT -->
	<script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
	<script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	{{--<script type="text/javascript" src="{{asset('assets/js/jquery.js')}}"></script>--}}
{{--	<script type="text/javascript" src="{{asset('assets/js/bootstrap.js')}}"></script>--}}
	<script type="text/javascript" src="{{asset('assets/js/load.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/js/main.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/js/app.js')}}"></script>
	<!-- /MAIN EFFECT -->
	<script type="text/javascript" src="{{asset('assets/js/iCheck/jquery.icheck.js')}}"></script>
	<!-- GAGE -->
	<script type="text/javascript" src="{{asset('assets/js/toggle_close.js')}}"></script>
	<script src="{{asset('assets/js/footable/js/footable.js?v=2-0-1')}}" type="text/javascript"></script>
	<script src="{{asset('assets/js/footable/js/footable.paginate.js?v=2-0-1')}}" type="text/javascript"></script>

	<script>
		$(document).ready(function() {
			//CHECKBOX PRETTYFY
			$('input').iCheck({
				checkboxClass: 'icheckbox_flat-purple',
				radioClass: 'iradio_flat-blue'
			});
		});
	</script>

	<script>
		function changeValue(obj) {
			// alert("changed value is " + obj);
			//console.log(obj);
			var baseurl = "http://www.do-api.com/cuiwang/weixin/";
			var weburl = baseurl + obj + "/";
			document.getElementById("weburl").placeholder = weburl;
		}
	</script>
	@endsection
