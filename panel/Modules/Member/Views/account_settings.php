<div class="row">
    <div class="col-md-12">
    <div class="portlet">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-reorder"></i>Account Settings
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"></a>
						<a href="#portlet-config" data-toggle="modal" class="config"></a>
						<a href="javascript:;" class="reload"></a>
						<a href="javascript:;" class="remove"></a>
					</div>
				</div>
				<div class="portlet-body">
					
					<div class="row">
						<div class="col-md-12">
							<table id="user" class="table table-bordered table-striped">
							<tbody>
							<tr>
								<td>
									 Member ID
								</td>
								<td>
									<?=$member_details['member_id']?>
								</td>
							</tr>
							<tr>
								<td>
									 First name
								</td>
								<td>
									<a href="#" id="firstname" data-type="text" data-pk="1" data-placement="right" data-placeholder="Required" data-original-title="Enter your firstname"><?=$member_details['firstname']?></a>
								</td>
							</tr>
							<tr>
								<td>
									 MI
								</td>
								<td>
									<a href="#" id="middlename" data-type="text" data-pk="1" data-placement="right" data-placeholder="Required" data-original-title="Enter your MI"><?=$member_details['middlename']?></a>
								</td>
							</tr>
							<tr>
								<td>
									 Last name
								</td>
								<td>
									<a href="#" id="lastname" data-type="text" data-pk="1" data-placement="right" data-placeholder="Required" data-original-title="Enter your lastname"><?=$member_details['lastname']?></a>
								</td>
							</tr>
							<tr>
								<td>
									 Age
								</td>
								<td>
									<a href="#" id="age" data-type="text" data-pk="1" data-placement="right" data-placeholder="Required" data-original-title="Enter your age"><?=$member_details['age']?></a>
								</td>
							</tr>
							<tr>
								<td>
									 Gender
								</td>
								<td>
									<a href="#" id="gender" data-type="select" data-pk="1" data-value="<?=$member_details['gender']?>" data-original-title="Select gender"></a>
								</td>
							</tr>
							<tr>
								<td>
									 Email address
								</td>
								<td>
									<a href="#" id="email" data-type="text" data-pk="1" data-placement="right" data-placeholder="Required" data-original-title="Enter your Email address"><?=$member_details['email']?></a>
								</td>
							</tr>
							<tr>
								<td>
									 Date of birth
								</td>
								<td>
									<a href="#" id="birthdate" data-type="combodate" data-value="<?=$member_details['birthdate']?>" data-format="YYYY-MM-DD" data-viewformat="DD/MM/YYYY" data-template="D / MMM / YYYY" data-pk="1" data-original-title="Select Date of birth"></a>
								</td>
							</tr>
							<tr>
								<td>
									 Mobile no
								</td>
								<td>
									<a href="#" id="mobile_no" data-type="text" data-pk="1" data-placement="right" data-placeholder="Required" data-original-title="Enter your Mobile no"><?=$member_details['mobile_no']?></a>
								</td>
							</tr>
							<tr>
								<td>
									 TIN
								</td>
								<td>
									<a href="#" id="tin" data-type="text" data-pk="1" data-placement="right" data-placeholder="Required" data-original-title="Enter your TIN"><?=$member_details['tin']?></a>
								</td>
							</tr>
							<tr>
								<td>
									 Civil Status
								</td>
								<td>
									<a href="#" id="civil_status" data-type="select" data-pk="1" data-value="<?=$member_details['civil_status']?>" data-original-title="Select Civil Status"></a>
								</td>
							</tr>

							<tr>
								<td>
									 Country
								</td>
								<td>
									<a href="#" id="country" data-type="select2" data-pk="1" data-value="<?=$member_details['country']?>" data-original-title="Select country"></a>
								</td>
							</tr>
							<tr>
								<td>
									 Address
								</td>
								<td>
									<a href="#" id="address" data-type="address" data-pk="1" data-original-title="Please, fill address" data-street="<?=$member_details['address']?>" data-province="<?=$member_details['province']?>" data-city="<?=$member_details['city']?>" data-postal_code="<?=$member_details['postal_code']?>"></a>
								</td>
							</tr>
							<tr>
								<td>
								<h3>Mode of Payment</h3> Cash
								</td>
								<td>
									<a href="#" id="mop_cash" data-type="text" data-pk="1" data-placement="right" data-placeholder="Required" data-original-title="Enter your cash"></a>
								</td>
							</tr>
							<tr>
								<td>
									Bank Deposit
								</td>
								<td>
									<a href="#" id="mop_bank_deposit" data-type="text" data-pk="1" data-placement="right" data-placeholder="Required" data-original-title="Enter your Bank Deposit"></a>
								</td>
							</tr>
							<tr>
								<td>
								<h3>Payout Info</h3> Bank Details
								</td>
								<td>
									<a href="#" id="mop_bank_details" data-type="text" data-pk="1" data-placement="right" data-placeholder="Required" data-original-title="Enter your cash"></a>
								</td>
							</tr>
							</tbody>
							</table>
						</div>
					</div>
					
				</div>
			</div>
    </div>
</div>