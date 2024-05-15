            <!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Formulaire</h3>
						</div>

						<div class="title_right">
							<div class="col-md-5 col-sm-5  form-group pull-right top_search">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Search for...">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button">Go!</button>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Paiement <small>formulaire</small></h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
                                    <form id="formPaiement" class="form-horizontal form-label-left">
										<input type="hidden" class="form-control" name="iddc" value="<?php echo $iddc; ?>">
										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Date de paiement</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="date" class="form-control" name="datepaie">
											</div>
										</div>
                                        <div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Montant</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="number" class="form-control" name="montant" placeholder="Montant de paie">
											</div>
										</div>
										<div class="x_content">
											<button type="submit" class="btn btn-success">Payer</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<script>
						$(document).ready(function() {
							$('#formPaiement').on('submit', function(e) {
								e.preventDefault();
								var datepaie = $(this).find('input[name="datepaie"]').val();
								var montant = $(this).find('input[name="montant"]').val();

								$.ajax({
									url: '<?php echo site_url('CTL_Paiement/payer');?>',
									type: 'POST',
									data: {datepaie: datepaie, montant: montant, iddc: $(this).find('input[name="iddc"]').val()},
									success: function(response) {
										var data = JSON.parse(response);
										if (data.success) {
											alert(data.message);
										} else {
											alert(data.message);
										}
									}
								});
							});
						});


					</script>
				</div>
			</div>
			<!-- /page content -->