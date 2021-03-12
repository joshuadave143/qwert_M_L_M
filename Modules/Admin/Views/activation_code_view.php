<div class="row">
    <div class="col-md-6">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit"></i>Activation Codes not use
                </div>
                
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <a id="generator" data-toggle="modal" href="#codes" class="btn btn-success">
                                    Generate Codes <i class="fa fa-cogs"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover table-bordered" id="activation_table">
                    <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Package Name
                            </th>
                            <th>
                                Package Amount
                            </th>
                            <th>
                                Activation Code
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
    <div class="col-md-6">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit"></i>Activation Codes already used
                </div>
                
            </div>
            <div class="portlet-body">
                
                <table class="table table-striped table-hover table-bordered" id="activated_table">
                    <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Package Name
                            </th>
                            <th>
                                Package Amount
                            </th>
                            <th>
                                Activation Code
                            </th>
                            <th>
                                Date Activated
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>

    <div class="modal fade" id="codes" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Code Generator</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Package</label>
                        <select multiple="" class="form-control" id="packageList">
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Total</label>
                        <input type="number" class="form-control" id="total" placeholder="Total">
                        <span class="help-block">
                            Total of codes generated Ex. 4 (4 codes will be generated) </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="generate" class="btn btn-info">Generate</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>