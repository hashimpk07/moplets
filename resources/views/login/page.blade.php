@extends("layouts.adminlte.login")

@section("content")

	<?php echo Form::open(array('action' => 'LoginController@onSubmit', 'id' => 'idLoginForm' ) ); ?>

	<div class="login-box">
		<div class="login-logo">
			<a href="dashbord.html"><b>{{ CONST_BRAND_NAME }}</b></a>
		</div><!-- /.login-logo -->
		<div class="login-box-body">
			<p class="login-box-msg">Sign in to start your session</p>
			<form action="dashbord.html" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<span class="block input-icon input-icon-right" style="width: 100%; margin: 5px 0">
			<label class="alert-warning clear" id="idFailureMsg"></label>
			<label class="alert-info clear" id="idSuccessMsg"></label>
		</span>

				<div class="form-group has-feedback">
					<input type="text" placeholder="Username" name="username" class="form-control" placeholder="Email">



				</div>
				<div class="form-group has-feedback">
					<input type="password" class="form-control" placeholder="Password" name="password">

				</div>
				<div class="row">
					<div class="col-xs-8">
						<div class="checkbox icheck">

						</div>
					</div><!-- /.col -->
					<div class="col-xs-4">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
					</div><!-- /.col -->
				</div>
			</form>

		</div><!-- /.login-box-body -->
	</div><!-- /.login-box -->



	<?php echo Form::close(); ?>

@stop

<script type="text/javascript">
	function doLoginValidation()
	{
		return true ;
	}

	document.addEventListener('onPageReady', function (e) {
		/* submitForm( formName, beforeFunctionm, afterFunction, targetId, autofill json response); */
		submitForm('idLoginForm', doLoginValidation, function (data) {
		}, '', true, {});
	}) ;


</script>