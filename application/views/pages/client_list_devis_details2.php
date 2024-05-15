<?php if(!isset($detailsList)) $detailsList = array(); ?>
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
                                <h2>Devis <small>détails</small></h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<table class="table">
                                        <thead>
                                          <tr>
                                            <th>Code</th>
                                            <th>Désignation</th>
											<th>Prix Unitaire</th>
											<th>Quantité</th>
											<th>Montant</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($detailsList as $detail){ ?>
                                          <tr>
                                            <td><?php echo $detail->code_st; ?></td>
                                            <td><?php echo $detail->designation; ?></td>
											<td><?php echo number_format($detail->pu, 2, '.', ' '); ?></td>
											<td><?php echo number_format($detail->qte, 2, '.', ' '); ?></td>
											<td><?php echo number_format($detail->montant, 2, '.', ' '); ?></td>
                                          </tr>
                                        <?php } ?>
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<th>Total</th>
												<th><?php echo number_format($dcList->montant, 2, '.', ' '); ?></th>
											</tr>
											<tr>
												<th></th>
												<th></th>
												<th>Finition : </th>
												<th><?php echo $dcList->finition; ?></th>
												<th><?php echo number_format($dcList->pourcentage, 2, '.', ' '); ?></th>
											</tr>
											<tr>
												<th></th>
												<th></th>
												<td></td>
												<th>Montant Total</th>
												<th><?php echo number_format($dcList->montant_total, 2, '.', ' '); ?></th>
											</tr>
                                        </tbody>
                                      </table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /page content -->