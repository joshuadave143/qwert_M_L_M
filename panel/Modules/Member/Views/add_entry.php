<div class="row">
    <div class="col-md-12">
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-reorder"></i>Add entry
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <?php 
                    if(isset($validation)):?>
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <span>
                        <?= $validation?>
                    </span>
                </div>
                <?php elseif($success): ?>
                <div class="alert alert-success">
                    <button class="close" data-close="alert"></button>
                    <span>
                        <?= $message?>
                    </span>
                </div>
                <?php endif?>
                <form action="#" class="form-horizontal" method="post">
                    <div class="form-body">
                        <h3 class="form-section">Person Info</h3>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label col-md-3">First Name <span
                                            style="color: red;">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="firtname" placeholder="First Name"
                                            value='<?=set_value('firtname') ?>'>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label col-md-3">MI <span style="color: red;">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="middlename" placeholder="MI"
                                            value='<?=set_value('middlename') ?>'>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Last Name <span
                                            style="color: red;">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="lastname" placeholder="Last Name"
                                            value='<?=set_value('lastname') ?>'>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <!--/span-->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label col-md-5">Age <span style="color: red;">*</span></label>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" name="age" placeholder="Age"
                                            value='<?=set_value('age') ?>'>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Gender <span
                                            style="color: red;">*</span></label>
                                    <div class="col-md-8">
                                        <div class="radio-list">
                                            <label class="radio-inline">
                                                <input type="radio" name="gender" value="1"
                                                    <?=set_value('gender')=="1"? 'checked':'' ?> />
                                                Male </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="gender" value="2"
                                                    <?=set_value('gender')=="2"? 'checked':'' ?> />
                                                Female </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Email address <span
                                            style="color: red;">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="email" placeholder="Email address"
                                            value='<?=set_value('email') ?>'>

                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <!--/span-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-md-5">Date of Birth <span
                                            style="color: red;">*</span></label>
                                    <div class="col-md-7">
                                        <input type="date" class="form-control" name="birthdate"
                                            placeholder="dd/mm/yyyy" value='<?=set_value('birthdate') ?>'>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Mobile no <span
                                            style="color: red;">*</span></label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" name="mobile_no" placeholder="Mobile no"
                                            value='<?=set_value('mobile_no') ?>'>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label col-md-3">TIN <span style="color: red;">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="tin" placeholder="TIN"
                                            value='<?=set_value('tin') ?>'>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <div class="row">

                            <div class="col-md-9">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Civil Status <span
                                            style="color: red;">*</span></label>
                                    <div class="col-md-8">
                                        <div class="radio-list">
                                            <label class="radio-inline">
                                                <input type="radio" name="civil_status" value="Single"
                                                    <?=set_value('civil_status')=="Single"? 'checked':'' ?> />
                                                Single
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="civil_status" value="Married"
                                                    <?=set_value('civil_status')=="Married"? 'checked':'' ?> />
                                                Married
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="civil_status" value="Divorced"
                                                    <?=set_value('civil_status')=="Divorced"? 'checked':'' ?> />
                                                Divorced
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="civil_status" value="Separated"
                                                    <?=set_value('civil_status')=="Separated"? 'checked':'' ?> />
                                                Separated
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="civil_status" value="Widowed"
                                                    <?=set_value('civil_status')=="Widowed"? 'checked':'' ?> />
                                                Widowed
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3 class="form-section">Address</h3>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Address <span
                                            style="color: red;">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" name="address" class="form-control" placeholder="Address"
                                            value='<?=set_value('address') ?>'>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">City <span
                                            style="color: red;">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" name="city" class="form-control" placeholder="City"
                                            value='<?=set_value('city') ?>'>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Province <span
                                            style="color: red;">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" name="province" class="form-control" placeholder="Province"
                                            value='<?=set_value('province') ?>'>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Postal Code <span
                                            style="color: red;">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" name="postal_code" class="form-control"
                                            placeholder="Postal Code" value='<?=set_value('postal_code') ?>'>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Country <span
                                            style="color: red;">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="country"
                                            <?=set_value('country') == '{country_id}'?'selected':'' ?>>
                                            {country_list}
                                            <option value="{country_id}" {selected}>{cname}</option>
                                            {/country_list}

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <h3 class="form-section">Mode of Payment</h3>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Cash</label>
                                    <div class="col-md-9">
                                        <input type="text" name="mop_cash" class="form-control" placeholder="Cash"
                                            value='<?=set_value('mop_cash') ?>'>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Bank Deposit</label>
                                    <div class="col-md-9">
                                        <input type="text" name="mop_bank_deposit" class="form-control"
                                            placeholder="Bank Deposit" value='<?=set_value('mop_bank_deposit') ?>'>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3 class="form-section">Payout Info</h3>
                        <div class="row">
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Bank Details</label>
                                    <div class="col-md-9">
                                        <input type="text" name="mop_bank_details" class="form-control"
                                            placeholder="Bank Details" value='<?=set_value('mop_bank_details') ?>'>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        <button type="button" class="btn btn-default">Cancel</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>