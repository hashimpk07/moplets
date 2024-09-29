<section class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Horizontal Form -->
			<div class="box box-info">
				<div class="box-header with-border">


				</div><!-- /.box-header -->
				<!-- form start -->
				<div id="PasswordAddWrap">
					<div id="PasswordAddContainer">


							<?php echo Form::open(array( 'url' => $url, 'id' => 'PasswordAddWrap', 'class' => 'form-horizontal' ) );  ?>
							<div class="box-body box-50-center">
								<div class="form-group">
									<label for="name" class="col-md-4 control-label  qrd-mandatory">Current Password</label>
									<div class="col-md-8">
										<input type="password" class="form-control" name="currentPassword" id="currentPassword"
											   placeholder="Current Password">
										<label class="qrd-error" id="ecurrentPassword"></label>
									</div>
								</div>
								<div class="form-group">
									<label for="userName" class="col-md-4 control-label qrd-mandatory">New Password</label>
									<div class="col-md-8">
										<input type="password" class="form-control" name="newPassword" id="newPassword"
											   placeholder="New Password">
										<label class="qrd-error" id="enewPassword"></label>
									</div>
								</div>
								<div class="form-group">
									<label for="password" class="col-md-4 control-label qrd-mandatory">Confirm New Password</label>
									<div class="col-md-8">
										<input type="password" class="form-control" name="conformPassword" id="conformPassword"
											   placeholder="Confirm New Password">
										<label class="qrd-error" id="econformPassword"></label>
									</div>
								</div>







							</div>
							<!-- /.box-body -->
							<div class="box-footer">

								<button type="submit" class="btn btn-info_108">Save</button>

							</div><!-- /.box-footer -->
						<?php echo Form::close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

</section>
<script type="text/javascript">

	function doPasswordlValidation()
	{
		var a = {
			'#currentPassword' :{ func : 'required()' , errfield : '#ecurrentPassword', errmsg  : 'Current Password Required' },
			'#newPassword' :{ func : 'required()' , errfield : '#enewPassword', errmsg  : 'Password Required' },
			'#conformPassword@1' :{ func : 'required()' , errfield : '#econformPassword', errmsg  : 'Re enter Password' },
			'#conformPassword@2' :{ func : 'matchfield("newPassword")' , errfield : '#econformPassword', errmsg  : 'Password does not match' }
		};

		if( validateForm(a, '' ) )
		{
			return true ;
		}
		return false;
	}

	document.addEventListener('onPageReady', function (e) {
		submitForm('PasswordAddWrap', doPasswordlValidation, null, '', true, {} );
	}) ;

</script>