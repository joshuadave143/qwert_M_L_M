<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
			Account Status 
			<small>
				<span class="label label-sm label-{account_status_css_tags} ">
					{account_status} 
				</span>
			</small>
		</h3>
		
	</div>
</div>

<div class="row stats-overview-cont">
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3 id='referral'><i class="fa fa-ruble" style="font-size: 25px;"></i> {DIREC_REF}</h3>

				<p>Direct Referral</p>
			</div>
			<div class="icon">
				<i class="ion ion-ios-body"></i>
			</div>

			<div class="small-box-footer">
				<a href="#" class="col-xs-6 btn btn-success collect" data='referral'>Collect <i class="fa fa-credit-card"></i></a>
				<a href="direct_referrals" class="col-xs-6 btn btn-primary ">Details <i class="fa fa-list-alt"></i></a>
			</div>
		</div>
	</div>

	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-yellow">
			<div class="inner">
				<h3 id='Inreferral'><i class="fa fa-ruble" style="font-size: 25px;"></i> {INDI_REF}</h3>

				<p>Indirect Referral</p>
			</div>
			<div class="icon">
				<i class="ion ion-ios-people-outline"></i>
			</div>
			<div class="small-box-footer">
				<a href="#" class="col-xs-6 btn btn-success collect" data='Inreferral'>Collect <i class="fa fa-credit-card"></i></a>
				<a href="indirect_referrals" class="col-xs-6 btn btn-primary ">Details <i
						class="fa fa-list-alt"></i></a>
			</div>
		</div>
	</div>

	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-red">
			<div class="inner">
				<h3 id='unilevel'><i class="fa fa-ruble" style="font-size: 25px;"></i> {UNILEVEL}</h3>

				<p>Over All Unilevel</p>
			</div>
			<div class="icon">
				<i class="ion ion-bag"></i>
			</div>

			<div class="small-box-footer">
				<a href="#" class="col-xs-6 btn btn-success collect" data='unilevel'>Collect <i class="fa fa-credit-card"></i></a>
				<a href="unilevel" class="col-xs-6 btn btn-primary ">Details <i class="fa fa-list-alt"></i></a>
			</div>
		</div>
	</div>

	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-green">
			<div class="inner">
				<h3>B{RPT}</h3>

				<p>RPT</p>
			</div>
			<div class="icon">
				<i class="ion ion-network"></i>
			</div>

			<div class="small-box-footer">
				<a href="#" class="col-xs-6 btn btn-success collect" data='rpt'>Collect <i class="fa fa-credit-card"></i></a>
				<a href="#" class="col-xs-6 btn btn-primary ">Details <i class="fa fa-list-alt"></i></a>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-3">
		<div class="portlet ">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-barcode"></i> Product code
				</div>
			</div>
			<div class="portlet-body util-btn-margin-bottom-5 product_code_body">
				<h4></h4>
				<form role="form">
					<div class="row">
						<div class="col-md-12">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Ex: prod-abCdEfgh" id="code">
								<span class="input-group-btn">
									<button class="btn btn-info" type="button" id="productcode">Claim</button>
								</span>
							</div>
							<!-- /input-group -->
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="portlet ">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-credit-card"></i> Payout
				</div>
			</div>
			<div class="portlet-body util-btn-margin-bottom-5 product_code_body">
				<button type="button" class="btn btn-primary" id="Payout"><i class="fa fa-paper-plane"></i> Request Payout</button>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-money"></i>Income Summary
				</div>
			</div>
			<div class="portlet-body flip-scroll">
				<table class="table table-bordered table-striped table-condensed flip-content">
				<thead class="flip-content">
					<tr>
						<th>
								&nbsp;
						</th>
						<th>
								E-wallet
						</th>
						<th class="numeric">
								Collectables
						</th>
						<th class="numeric">
								Pending
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
								Direct Referral
						</td>
						<td>
								P {E_DIREC_REF}
						</td>
						<td class="numeric">
								P {DIREC_REF}
						</td>
					</tr>
					<tr>
						<td>
								Indirect Referral
						</td>
						<td>
								P {E_INDI_REF}
						</td>
						<td class="numeric">
								P {INDI_REF}
						</td>
					</tr>
					<tr>
						<td>
								Unilevel
						</td>
						<td>
								P {E_UNI_COL}
						</td>
						<td class="numeric">
								P {UNI_COL}
						</td>
						<td class="numeric">
								P {UNI_PENDING}
						</td>
					</tr>
					<tr>
						<td>
								Points
						</td>
						<td>
								P {E_UNI_POINTS}
						</td>
						<td>
								P {UNI_POINTS}
						</td>
						<td class="numeric">
								P {UNI_POINTS_P}
						</td>
					</tr>
					<tr>
						<td>
								<b>Total</b>
						</td>
						<td>
								<b>P {E_TOTAL}</b>
						</td>
						<td class="numeric">
								<b>P {COL_TOTAL}</b>
						</td>
						<td class="numeric">
								<b>P {PENDING_TOTAL}</b>
						</td>
					</tr>
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!--  -->