<div class="box box-info">
	<div class="box-header with-border">
    <div id="ExecutiveAddForm" class="{{$QRD_MODE or ''}}" >
	<?php echo Form::open(array( 'url' => $url, 'id' => 'ExecutiveForm', 'class' => 'form-horizontal' ) );  ?>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="form-group">
				<label class="col-md-3 control-label  qrd-mandatory" for="executiveName">
					Name </label>
				<div class="col-sm-9">
					<input type="text" id="executiveName" name="executiveName" placeholder="Executive Name"
						   class="col-xs-10 col-sm-5 form-control" value="{{ @$record->name }}" />
					<label class="qrd-error executiveName" id="eexecutiveName"></label>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label  qrd-mandatory" for="executiveUserName">Username
					</label>

				<div class="col-sm-9">
					<input type="text" id="executiveUserName" name="executiveUserName"
						   placeholder="User Name"
						   class="col-xs-10 col-sm-5 form-control" value="{{ @$record->username }}"/>
					<label class="qrd-error executiveUserName" id="eexecutiveUserName"></label>
				</div>
			</div>
			<div class="form-group qrd-no-view ">
				<label class="col-md-3 control-label  qrd-mandatory" for="executivePassword">Password
				</label>

				<div class="col-sm-9">
					<input type="password" id="executivePassword" name="executivePassword"
						   placeholder="Password"
						   class="col-xs-10 col-sm-5 form-control"  />
					<label class="qrd-error executivePassword" id="eexecutivePassword"></label>
				</div>
			</div>
			<?php
			if(CONST_MODULE_REGION==1) { ?>
			<div class="form-group">
				<label class="col-md-3 control-label  qrd-mandatory" for="executiveRegion">Regions
				</label>

				<div class="col-sm-9">
					<select id="executiveRegion" name="executiveRegion[]" class="form-control select2" multiple="multiple" data-placeholder="Select a Region" style="width: 100%;">
						{!! DEFAULT_SELECT_TEXT !!}
						@foreach( $regionOptions as $key => $value )
							<option {{((isset($executiveRegions[$key])) ? 'selected="selected' : '') }} value="{{ $key }}">{{ $value }}</option>
						@endforeach
						</select>
					<label class="qrd-error executiveRegion" id="eexecutiveRegion"></label>
				</div>
			</div>
			<?php }
			 if(CONST_MODULE_BRANCH==1) { ?>
			<div class="form-group">
				<label class="col-md-3 control-label  qrd-mandatory" for="executiveBranch">Branches
				</label>

				<div class="col-sm-9">
					<select id="executiveBranch" name="executiveBranch[]" class="form-control select2" multiple="multiple" data-placeholder="Select a Branches" style="width: 100%;">
						{!! DEFAULT_SELECT_TEXT !!}
						@foreach( $branchOptions as $key => $value )
                       <option {{ ((isset($executiveBranches[$key])) ?  'selected="selected' : '') }} value="{{ $key }}">{{ $value }}</option>

						@endforeach
					</select>
						<label class="qrd-error executiveBranch" id="eexecutiveBranch"></label>
				</div>
			</div>
        <?php } ?>
		</div><!-- /.col -->

	</div><!-- /.col -->
	<div class="col-md-12 ">
		<div class="clearfix form-actions">
			<div class="col-md-offset-3 col-md-9 col-xs-12">

				<button class="qrd-no-view btn btn-info_108" type="submit">
					OK
				</button>
				<button class="btn btn-default" type="button" onclick="toggleAddForm('#ExecutiveAddWrap', false, '.qrd-add-button');">
					Cancel
				</button>
			</div>
		</div>
	</div>
	</form>
</div>
	</div><!-- /.box-header -->
	<!-- form start -->

</div>

<script type="text/javascript">

	function doExecutiveValidation()
	{
		var a = {

		<?php if(CONST_MODULE_REGION==1) { ?>
				'#executiveRegion': {func: 'notvalue()', errfield: '#eexecutiveRegion', errmsg: 'Select Region'},
			<?php }if(CONST_MODULE_BRANCH==1) { ?>
                    '#executiveBranch': {func: 'notvalue()', errfield: '#eexecutiveBranch', errmsg: 'Select Branch'},
			<?php } ?>
			<?php if($QRD_MODE == ADD ) { ?>
			'#executivePassword': {func: 'required()', errfield: '#eexecutivePassword', errmsg: 'Invalid Password'},
			<?php } ?>
          '#executiveName': {func: 'required()', errfield: '#eexecutiveName', errmsg: 'Invalid Name'},
			'#executiveUserName': {func: 'required()', errfield: '#eexecutiveUserName', errmsg: 'Invalid User Name'}

            };

		if( validateForm(a, '' ) )
		{
			return true ;
		}
		return false ;
	}


		submitForm('ExecutiveForm', doExecutiveValidation, null, '', true,  {
			"click" : ".refreshHtmlTable",
			"hide_if_ok" : '#ExecutiveAddWrap'
		} );


	$(".select2").select2();
</script>


