<?php if(!isset($devisList)) $devisList = array(); ?>
<!-- page content -->
<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Liste</h3>
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
                                <h2>Devis <small>ma liste</small></h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<table class="table">
                                        <thead>
                                          <tr>
										  	<th>Ref</th>
                                            <th>Maison</th>
                                            <th>Finition</th>
                                            <th>Date du devis</th>
											<th>Date début des travaux</th>
											<th>Date fin des travaux</th>
											<th>Montant à payer</th>
											<th></th>
											<th></th>
											<th></th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($devisList as $devis){ ?>
                                          <tr>
										  	<td><?php echo $devis->refdevis; ?></td>
                                            <td><?php echo $devis->maison; ?></td>
                                            <td><?php echo $devis->finition; ?></td>
                                            <td><?php echo $devis->datecreation; ?></td>
											<td><?php echo $devis->datedebut; ?></td>
											<td><?php echo $devis->datefin; ?></td>
											<td><?php echo number_format($devis->montant_total, 2, '.', ' '); ?></td>
											<td><a href="<?php echo site_url('CTL_DevisClient/ExportPDF'); ?>?iddc=<?php echo $devis->id; ?>" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> Export PDF</a></td>
											<td><a href="<?php echo site_url('CTL_Paiement/index'); ?>?iddc=<?php echo $devis->id; ?>" class="btn btn-primary btn-sm">Paiement</a></td>
                                          </tr>
                                        <?php } ?>
                                        </tbody>
                                      </table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /page content -->