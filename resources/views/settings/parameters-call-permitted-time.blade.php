<div class="col-md-6">
	<!-- Horizontal Form -->
	<div class="box box-info">
		<div class="element-08 with-border"></div>
		<!-- form start -->
		<div id="ParameterCallPermittedAddWrap">
			<div id="BranchAddContainer">
				<?php echo Form::open(array( 'url' => 'settings/onParameterCallPermitted', 'id' => 'ParameterCallPermittedAddForm', 'class' => 'form-horizontal' ) );  ?>
				<div class="box-header with-border">
					<h3 class="box-title">Call Permitted Time</h3>
				</div>

				<div class="box-body ">
					<div >
						<div class="col-xs-12 col-sm-6">

							<label for="startTime" class="timer start col-sm-6">Start
								Time</label>

							<div class="input-group bootstrap-timepicker 2 col-sm-6">
								<input id="startTime" type="text" name="startTime"
									   class="form-control timepicker1" value="{{ $START_TIME }}"/>

							</div>
						</div>

						<div class="col-xs-12 col-sm-6">
							<label for="endTime" class="timer start col-md-6 ">End
								Time</label>

							<div class="input-group bootstrap-timepicker 2 col-md-6">
								<input  type="text" name="endTime" id="endTime"
										class="form-control timepicker1" value="{{ $END_TIME }}"/>

							</div>

						</div>
						<div class="col-xs-12 col-sm-6">
							<div class="check-1">
								<input type="checkbox" id="permitDays" name="permitDays" value="1" {{ $PROCESS_PAST_CALLS == '1' ? 'checked' :'' }}> Permit call from previous days
							</div>


						</div>

					</div>
				</div><!-- /.box-body -->
				<div class="elements-7">
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

	function doParameterCallPermittedValidation()
	{
		return true ;
	}

	document.addEventListener('onPageReady', function (e) {
		submitForm('ParameterCallPermittedAddForm', doParameterCallPermittedValidation, null, ' ', true, {} );
	}) ;

</script>