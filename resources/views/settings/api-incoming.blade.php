<div class="col-md-6">
	<!-- Horizontal Form -->
	<div class="box box-info">
		<div class="element-08 with-border"></div><!-- /.box-header -->
		<!-- form start -->
		<div id="apiAddWrap">
			<div id="apiIncomingAddContainer">
				<div class="box-header with-border">
					<h3 class="box-title">Receiving Request</h3>
				</div>
				<?php echo Form::open(array( 'url' => 'settings/onApiCall', 'id' => 'apiIncomingAddContainer', 'class' => 'form-horizontal' ) );  ?>
				<div class="box-body ">

					<label for="apiKeyName" class="col-md-5 control-label">API Authentication Key</label>

					<div class="col-md-7">
						<input type="text" class="form-control"
							   name="apiKeyName" id="apiKeyName"
							   placeholder="API Key" value="{{ $API_KEY }}">
						<label class="qrd-error" id="eapiKeyName"></label>
					</div>


				</div><!-- /.box-body -->
				<div class="elements-9">
					<div class="box-footer">
						<button type="submit" class="btn btn-info_108">OK
						</button>
					</div>
				</div>
				<!-- /.box-footer -->
				</form>
			</div>

		</div>
	</div>
</div>
<script type="text/javascript">

	function doApiIncomingValidation()
	{
		return true ;
	}

	document.addEventListener('onPageReady', function (e) {
		submitForm('apiIncomingAddContainer', doApiIncomingValidation, null, ' ', true, {} );
	}) ;

</script>