
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-success">Save changes</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN STYLE CUSTOMIZER -->
			<div class="theme-panel hidden-xs hidden-sm">
				<div class="toggler">
					<i class="fa fa-gear"></i>
				</div>
				<div class="theme-options">
					<div class="theme-option theme-colors clearfix">
						<span>
							 Theme Color
						</span>
						<ul>
							<li class="color-black current color-default tooltips" data-style="default" data-original-title="Default">
							</li>
							<li class="color-grey tooltips" data-style="grey" data-original-title="Grey">
							</li>
							<li class="color-blue tooltips" data-style="blue" data-original-title="Blue">
							</li>
							<li class="color-red tooltips" data-style="red" data-original-title="Red">
							</li>
							<li class="color-light tooltips" data-style="light" data-original-title="Light">
							</li>
						</ul>
					</div>
					<div class="theme-option">
						<span>
							 Layout
						</span>
						<select class="layout-option form-control input-small">
							<option value="fluid" selected="selected">Fluid</option>
							<option value="boxed">Boxed</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
							 Header
						</span>
						<select class="header-option form-control input-small">
							<option value="fixed" selected="selected">Fixed</option>
							<option value="default">Default</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
							 Sidebar
						</span>
						<select class="sidebar-option form-control input-small">
							<option value="fixed">Fixed</option>
							<option value="default" selected="selected">Default</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
							 Sidebar Position
						</span>
						<select class="sidebar-pos-option form-control input-small">
							<option value="left" selected="selected">Left</option>
							<option value="right">Right</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
							 Footer
						</span>
						<select class="footer-option form-control input-small">
							<option value="fixed">Fixed</option>
							<option value="default" selected="selected">Default</option>
						</select>
					</div>
				</div>
			</div>
			<!-- END BEGIN STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Layouts <small>form layouts</small>
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="index.html">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Form Stuff</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Form Layouts</a>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
                    <div class="portlet">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-reorder"></i>New Member
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <?php echo validation_errors(); ?>

                            <?php echo form_open('new_member'); ?>
                            <!-- <form action="#" class="horizontal-form"> -->
                                <div class="form-body">
                                    <h3 class="form-section">Person Info <?=var_dump($test)?></h3>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label">First Name *</label>
                                                <input type="text" id="firstName" name="firstName" value="<?=set_value('firstName');?>" class="form-control" placeholder="Chee Kin" <!--required-->
                                                
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label class="control-label">M.I.</label>
                                                <input type="text" id="MI"  name="MI" value="<?=set_value('MI');?>" class="form-control" placeholder="I">
                                                
                                            </div>
                                        </div>                                    		
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Last Name  *</label>
                                                <input type="text" id="lastName" name="lastName" value="<?=set_value('lastName');?>" class="form-control" placeholder="Lim" <!--required-->
                                               
                                            </div>
                                        </div>                                		
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label class="control-label">Name ext.  </label>
                                                <input type="text" id="nameext" name="nameext" value="<?=set_value('nameext');?>" class="form-control" placeholder="(JR., SR)">
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="control-label">Gender</label>
                                                <select class="form-control" name="gender">
                                                    <option value="Male" <?=set_select('gender', 'Male')?>>Male</option>
                                                    <option value="Female" <?=set_select('gender', 'Female')?>>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="control-label">Date of Birth *</label>
                                                <input type="date" class="form-control" value="<?=set_value('dbirth');?>" name="dbirth" placeholder="dd/mm/yyyy" <!--required-->
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="control-label">Civil status *</label>
                                                <select class="form-control" name="cstatus">
                                                    <option value="select">select</option>
                                                    <option value="Single" <?=set_select('cstatus', 'Single')?>>Single</option>
                                                    <option value="Married" <?=set_select('cstatus', 'Married')?>>Married</option>
                                                    <option value="Widowed" <?=set_select('cstatus', 'Widowed')?>>Widowed</option>
                                                    <option value="Separated" <?=set_select('cstatus', 'Separated')?>>Separated</option>
                                                    <option value="Divorced" <?=set_select('cstatus', 'Divorced')?>>Divorced</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Region *</label>
                                                <input type="text" class="form-control" id="region" value="<?=set_value('region');?>" name="region" placeholder="Region" <!--required-->
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Email *</label>
                                                <input type="text" class="form-control" id="email" name="email" value="<?=set_value('email');?>" placeholder="joshua@gmail.com" <!--required-->
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Tel No.</label>
                                                <input type="text" class="form-control" id="telno" name="telno" value="<?=set_value('telno');?>" placeholder="223-2524">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Mobile No.</label>
                                                <input type="text" class="form-control" id="mobileno" name="mobileno" value="<?=set_value('mobileno');?>" placeholder="+63 916 321 2564">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">TIN No.</label>
                                                <input type="text" class="form-control" id="tinno" name="tinno" value="<?=set_value('tinno');?>" placeholder="123456789">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Bank name</label>
                                                <input type="text" class="form-control" id="bankname" name="bankname" value="<?=set_value('bankname');?>" placeholder="BPI, BDO, ETC.." <!--required-->
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Bank account</label>
                                                <input type="text" class="form-control" id="bankaccount" name="bankaccount" value="<?=set_value('bankaccount');?>" placeholder="123456798" <!--required-->
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Employee ID no</label>
                                                <input type="text" class="form-control" id="empid" name="empid" value="<?=set_value('empid');?>" placeholder="123456798" <!--required-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->
                                    
                                    <!--/row-->
                                    <h3 class="form-section">Address</h3>
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <label>Address *</label>
                                                <input type="text" class="form-control" name="address" value="<?=set_value('address');?>" <!--required-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->
                                    <h3 class="form-section">Source of Income</h3>
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <label>Company name *</label>
                                                <input type="text" id="company" class="form-control" name="company" value="<?=set_value('company');?>" <!--required-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Position *</label>
                                                <input type="text" id="position" class="form-control" name="position" value="<?=set_value('position');?>" <!--required-->
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Salary *</label>
                                                <input type="text" id="salary" class="form-control" name="salary" value="<?=set_value('salary');?>" <!--required-->
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                </div>
                                <div class="form-actions right">
                                    <button type="submit" class="btn btn-info" name="submit" value="submit"><i class="fa fa-check"></i> Save</button>
                                </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>