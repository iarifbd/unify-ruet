<!-- Row start -->
<div class="row gx-3">
	<div class="col-xl-3 col-sm-6 col-12">
		<div class="card mb-3">
			<div class="card-body bg-light bg-gradient">
				<div class="mb-2">
					<i class="bi bi-bar-chart fs-1 text-primary lh-1"></i>
				</div>
				<div class="d-flex align-items-center justify-content-between">
					<h5 class="m-0 text-secondary fw-normal">Sales</h5>
					<h3 class="m-0 text-primary">3500</h3>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-sm-6 col-12">
		<div class="card mb-3">
			<div class="card-body bg-light bg-gradient">
				<div class="mb-2">
					<i class="bi bi-bag-check fs-1 text-primary lh-1"></i>
				</div>
				<div class="d-flex align-items-center justify-content-between">
					<h5 class="m-0 text-secondary fw-normal">Orders</h5>
					<h3 class="m-0 text-primary">2900</h3>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-sm-6 col-12">
		<div class="card mb-3">
			<div class="card-body bg-light bg-gradient">
				<div class="arrow-label">+18%</div>
				<div class="mb-2">
					<i class="bi bi-box-seam fs-1 text-primary lh-1"></i>
				</div>
				<div class="d-flex align-items-center justify-content-between">
					<h5 class="m-0 text-secondary fw-normal">Items</h5>
					<h3 class="m-0 text-primary">6500</h3>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-sm-6 col-12">
		<div class="card mb-3">
			<div class="card-body bg-light bg-gradient">
				<div class="arrow-label">+24%</div>
				<div class="mb-2">
					<i class="bi bi-bell fs-1 text-primary lh-1"></i>
				</div>
				<div class="d-flex align-items-center justify-content-between">
					<h5 class="m-0 text-secondary fw-normal">Signups</h5>
					<h3 class="m-0 text-primary">7200</h3>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Row end -->
<div class="col-xxl-12">
	<div class="card mb-3">
		<div class="card-body bg-lig">
			<div class="custom-tabs-container">
				<ul class="nav nav-tabs" id="customTab3" role="tablist">
					<li class="nav-item" role="presentation">
						<a class="nav-link active" id="tab-oneAA" data-bs-toggle="tab" href="#oneAA" role="tab"
							aria-controls="oneAA" aria-selected="true"><i class="bi bi-box-seam"></i>Student's Top Sheet</a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link" id="tab-twoAA" data-bs-toggle="tab" href="#twoAA" role="tab"
							aria-controls="twoAA" aria-selected="false"><i class="bi bi-pie-chart"></i>Student Information</a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link" id="tab-threeAA" data-bs-toggle="tab" href="#threeAA" role="tab"
							aria-controls="threeAA" aria-selected="false"><i class="bi bi-printer"></i>Ledgers</a>
					</li>
					<li class="nav-item mdtbtn" role="presentation">
					</li>
				</ul>
				<div class="tab-content" id="customTabContent3">
					<div class="tab-pane fade show active" id="oneAA" role="tabpanel">
						<div class="row gx-3">
							<div class="col-sm-12 col-12">
								<!-- Card start -->
								<div class="card mb-3">
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-bordered m-0 mydatatable">
												<thead>
													<tr>
														<th>SL#</th>
														<th>Student ID#</th>
														<th>Total Payble</th>
														<th>Total Paid</th>
														<th>Outstanding</th>
														<th>Countable Months of Due</th>
														
													</tr>
												</thead>
	<tbody>
		<?php foreach ($StuLedg as $key => $value) :?>
		<tr>
			<td><?php echo ($key+1); ?></td>
			<td><?php echo $value['S_Id']; ?></td>
			<td>    
				<?php 
			    echo 'Hall Charge = ' . number_format($value['HallCharge'],2) . '/- <br>' . 
			         'Delay Fine = ' . number_format($value['DelayFine'],2) . '/- <br>' . 
			         '<strong>Total = ' .number_format($value['HallCharge'] + $value['DelayFine'],2).'BDT</strong>'; 
			    ?>
    		</td>
			<td><?php echo $value['Paid']; ?></td>
			<td><?php echo $value['Outstanding']; ?></td>
			<td><?php echo $value['DueCount']; ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
											</table>
										</div>										
									</div>
								</div>
								<!-- Card end -->
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="twoAA" role="tabpanel">
						<h3 class="text-danger">Some Description</h3>
					</div>
					<div class="tab-pane fade" id="threeAA" role="tabpanel">
						<h3 class="text-primary">Some Description</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>