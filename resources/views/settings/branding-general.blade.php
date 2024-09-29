<div class="col-sm-6">
	<div class="box box-info" id="brandingAddWrap">
		<div class="box-header with-border" >
			<h3 class="box-title">Brand Options</h3>
			<?php echo Form::open(array( 'url' => 'settings/onBrandingGeneral', 'id' => 'brandingAddWrap', 'class' => 'form-horizontal' ) );  ?>

			<div class="elements-7">
				<label for="BrandName">Brand Name</label>
				<input type="text" class="form-control" name="BrandName" id="BrandName" value="{{ $BRAND_NAME }}"
					   placeholder="Name">
				<label class="qrd-error" id="eBrandName"></label>
			</div>
			<div class="color margin-setting">
				<label>Choose theme color :</label>

				<div class="input-group my-colorpicker2">
					<input type="text" class="form-control" id="BrandColor" name="BrandColor" value="{{ $BRAND_COLOR }}">

					<div class="input-group-addon">
						<i></i>
					</div>
				</div>
			</div>
			<div class="elements-6">

				<label>Logo :</label><br/>
				<div id="imagePreview" class="margin-setting"><?php if($BRAND_IMAGE){ ?><image src="@yield('BRAND_IMAGE')"  style="width : 178px;height : 120px;" id="current_image"></image><?php } ?></div>

				<div class="margin-setting">
					<label>logo (134px X 74px) :</label><br/>
					<label><input id="uploadFile" type="file" name="BrandImage"  class="img"/></label>
				</div>

			</div>

			<!-- /.input group -->




		</div>
		<div class="user-logo">

			<div class="tic-2">
				<div class="box-footer">
					<button type="submit" class="btn btn-info_108">Save
					</button>
				</div>
			</div>
		</div>

	</div>
</div>
<script type="text/javascript">

	function doBrandingWrapValidation()
	{

	}

	document.addEventListener('onPageReady', function (e) {
		submitForm('brandingAddWrap', doBrandingWrapValidation , null, null, true, {} );
	}) ;

</script>