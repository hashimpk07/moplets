<div class="row">
    <div class="col-md-12">

        <div class="box box-info">
            <div class="element-02">
                <div class="box-header">
                    <div class='box-tools'>
                    </div>
                </div>
            </div>
            <div class="box-body toggle-form" id="texting" style="display:block">
                <?php echo Form::open(array( 'url' => action('ComparisonController@listtable'), 'id' => 'ComparisonForm', 'class' => 'form-horizontal' ) );  ?>
                <div class="row">
                    <div class="col-sm-6">
                        <label class="col-sm-3 control-label">From</label>

                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="datepicker form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                            </div><!-- /.input group -->
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label class="col-md-3 control-label">To</label>

                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="datepicker form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                            </div><!-- /.input group -->
                            <label class="qrd-error" id="eName"></label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <?php  if(CONST_MODULE_EMPLOYEE == 1) { ?>
                        <div class="col-sm-6">
                            <label for="sel_regions" class="col-md-3 control-label ">Employees</label>
                            <div class="col-md-9">
                                <!--<select id="sel_regions" name="sel_regions[]" class="form-control select2" multiple="multiple" data-placeholder="Select Employee" style="width: 100%;">
                                    <option>Employee1</option>
                                    <option>Employee 2</option>
                                </select>-->
                                <select id="employees" name="employees[]" class="form-control select2" multiple="multiple" data-placeholder="Select Employees" style="width: 100%;">
                                    {!! DEFAULT_SELECT_TEXT !!}
                                    @foreach( $employeeOptions as $key => $value )
                                        <option {{ ((@$$record->id == $key) ? 'selected="selected' : '') }} value="{{ $key }}">{{ $value }}</option>
                                    @endforeach

                                </select>
                                <!--    <label class="qrd-error" id="eRegions"></label>-->
                                <label class="qrd-error" id="eEmployees"></label>
                            </div>
                        </div>
                    <?php } ?>
                    <?php  if(CONST_MODULE_BRANCH == 1) { ?>
                        <div class="col-sm-6">

                            <label for="sel_regions" class="col-md-3 control-label ">Branches</label>
                            <div class="col-md-9">
                                <!-- <select id="sel_regions" name="sel_regions[]" class="form-control select2" multiple="multiple" data-placeholder="Select Branch" style="width: 100%;">
                                     <option>Branch 1</option>
                                     <option>Branch 2</option>
                                 </select>-->
                                <!--  <label class="qrd-error" id="eRegions"></label>-->
                                <select id="branches" name="branches[]" class="form-control select2" multiple="multiple" data-placeholder="Select Branches" style="width: 100%;">
                                    {!! DEFAULT_SELECT_TEXT !!}
                                    @foreach( $branchOptions as $key => $value )
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                <label class="qrd-error" id="eBranches"></label>
                            </div>
                        </div>
                    <?php } ?>
                        <div class="col-sm-6">
                            <label for="sel_regions" class="col-md-3 control-label ">Locations</label>
                            <div class="col-md-9">
                                <!--  <select id="sel_regions" name="sel_regions[]" class="form-control select2" multiple="multiple" data-placeholder="Select Location" style="width: 100%;">
                                      <option>Location 1</option>
                                      <option>Location 2</option>
                                  </select>-->
                                <select id="locations" name="locations[]" class="form-control select2" multiple="multiple" data-placeholder="Select Locations" style="width: 100%;">
                                    {!! DEFAULT_SELECT_TEXT !!}
                                    @foreach( $locationOptions as $key => $value )
                                        <option {{ ((@$$record->id == $key) ? 'selected="selected' : '') }} value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                <label class="qrd-error" id="eLocations"></label>
                            </div>
                        </div>

                    <?php  if(CONST_MODULE_REGION == 1) { ?>
                        <div class="col-sm-6">
                            <label for="sel_regions" class="col-md-3 control-label ">Regions</label>
                            <div class="col-md-9">
                                <select id="regions" name="regions[]" class="form-control select2" multiple="multiple" data-placeholder="Select Regions" style="width: 100%;">
                                    {!! DEFAULT_SELECT_TEXT !!}
                                    @foreach( $regionOptions as $key => $value )
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                <label class="qrd-error" id="eRegions"></label>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="col-sm-6">
                        <label for="sel_regions" class="col-md-3 control-label ">Chart</label>
                        <div class="col-md-9">
                            <div class="">
                                <label>
                                    <input type="radio" name="r1" class="minimal" value="barchart" id="barchart" checked>
                                    Bar Chart
                                </label>
                                &nbsp;&nbsp;
                                <label>
                                    <input type="radio" name="r1" value="piechart" id="piechart" class="minimal">
                                    Pie Chart
                                </label>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-info_108">Search</button>
                </div><!-- /.box-footer -->
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->



        <!-- /.content -->
    </div>

    <div id="ComparisonTableWrap">

    </div>

    <!-- /.box -->
</div>
<script type="text/javascript">

    function doExecutiveValidation()
    {
        return true ;
    }
    document.addEventListener('onPageReady', function (e) {

        /* submitForm( formName, beforeFunctionm, afterFunction, targetId, autofill json response); */
        submitForm('ComparisonForm', doExecutiveValidation, function(data) { }, 'ComparisonTableWrap', true, {
        } );

        jQuery(function () {
            //Initialize Select2 Elements
            jQuery(".select2").select2();
        });

        jQuery(".toggle-button").click(function(){
            jQuery(".toggle-form").toggle();
        });


    }) ;
</script>