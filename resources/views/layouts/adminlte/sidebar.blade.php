  <!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->

            <!-- /.search form -->
            <?php
                    $ActionName = \Qudratom\Utilities\Helper::actionDetail('name') ;
            ?>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
				<li class="treeview  {{ ($ActionName == 'Dashboard' ? 'active'  :'') }}">
                    <a href="dashboard"><i class="fa fa-tachometer"></i> <span>Dashbord</span></a>
                </li>

				<li class="treeview  {{ ($ActionName == 'Report' ? 'active'  :'') }}">
                    <a href="reports"><i class="fa fa-file-text"></i> <span>Report</span></a>
                </li>
                
                <li class="treeview  {{ ($ActionName == 'Comparison' ? 'active'  :'') }}">
                    <a href="comparison"><i class="fa fa-bar-chart"></i> <span>Comparison</span></a>
                </li>
                <hr class="link-line">
                <?php

                if(CONST_MODULE_BRANCH==1) { ?>

				<li class="treeview  {{ ($ActionName == 'Branch' ? 'active'  :'') }}">
                    <a href="branch">
                        <i class="fa fa-building-o	"></i><span> Branches</span></i>
                    </a>
                </li>
                <?php } ?>
				
                <li class="treeview  {{ ($ActionName == 'Location' ? 'active'  :'') }}">
                    <a href="location"><i class="fa fa-map-marker"></i> <span>Locations</span></a>
                </li>
                <?php if(CONST_MODULE_REGION==1) { ?>
                <li class="treeview  {{ ($ActionName == 'Region' ? 'active'  :'') }}">
                    <a href="region"><i class="fa fa-globe"></i> <span>Regions</span></a>
                </li>
                <?php }
                if(CONST_MODULE_EMPLOYEE==1){ ?>
				
                <li class="treeview  {{ ($ActionName == 'Employee' ? 'active'  :'') }}">
                    <a href="employees"><i class="fa fa-black-tie"></i> <span>Employees</span></a>
                </li>
                <?php } ?>
				<hr class="link-line">
                <?php
                if(Auth::user()->id==ADMIN_ID){ ?>
				<li class="treeview  {{ ($ActionName == 'Executive' ? 'active'  :'') }}">
                    <a href="executive"><i class="fa fa-user-plus"></i> <span>Executives</span></a>
                </li>

				<li class="treeview  {{ ($ActionName == 'Settings' ? 'active'  :'') }}">
                    <a href="settings"><i class="fa fa-cog"></i> <span>Settings</span></a>
                </li>

                <li class="treeview  {{ ($ActionName == 'History' ? 'active'  :'') }}">

                </li>
                <?php } ?>
                </li>

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>