<form id="SearchForm" action="<?php echo action( $SEARCH_CONTROLLER_PREFIX . 'Controller@listtable');?>" >

    <div class="element-01">
        <div class="input-group" style="width:150px; float:right;">
            <input type="text" name="search" id="tableSearch"
                   class="form-control input-sm pull-right" placeholder="Search" >
            <div class="input-group-btn">
                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </div>

</form>


<script type="text/javascript">
    function doSearchValidation()
    {
        return true;
    }

    document.addEventListener('onPageReady', function (e) {
        submitForm('SearchForm', doSearchValidation, null, '<?php echo $SEARCH_CONTROLLER_PREFIX ; ?>TableWrap', true, {});
    });
</script>