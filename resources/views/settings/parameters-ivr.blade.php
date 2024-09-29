<div class="col-md-6">
	<!-- Horizontal Form -->
	<div class="box box-info">
		<div class="element-08 with-border"></div>
		<!-- form start -->
		<div id="parameterAddWrap">
			<div id="parameterAddContainer">
				<div class="box-header with-border">
					<h3 class="box-title">Ivr </h3>
				</div>

				<?php echo Form::open(array( 'url' => 'settings/onParameterIvr', 'id' => 'parameterAddWrap', 'class' => 'form-horizontal' ) );  ?>
					<div class="box-body box-50-center">

						<label for="IvrDelay" class="Delay col-md-6 control-label">Delay</label>

						<div class=" col-md-6">
							<input type="number" class="form-control" name="IvrDelay" id="IvrDelay"
								     value="{{ $IVR_DELAY }}">
						</div>


					</div><!-- /.box-body -->
					<div class="elements-10">
						<div class="box-footer">
							<button type="submit" class="btn btn-info_108">Save
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

	function doParameterIvrValidation()
	{
		return true ;
	}

	document.addEventListener('onPageReady', function (e) {
		submitForm('parameterAddWrap', doParameterIvrValidation, null, ' ', true, {} );
	}) ;

</script>


