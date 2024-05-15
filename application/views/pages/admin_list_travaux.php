<?php if(!isset($travauxList)) $travauxList = array(); ?>
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
                                <h2>Travaux <small>liste</small></h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<table class="table">
                                        <thead>
                                          <tr>
                                            <th>Code</th>
                                            <th>Designation</th>
                                            <th>Unité</th>
											<th>Prix Unitaire</th>
											<th></th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($travauxList as $travaux){ ?>
                                          <tr>
                                            <td><?php echo $travaux->code; ?></td>
                                            <td><?php echo $travaux->designation; ?></td>
                                            <td><?php echo $travaux->unite; ?></td>
											<td><?php echo number_format($travaux->pu, 2, '.', ' '); ?></td>
											<td><a href="<?php echo site_url('CTL_Travaux/updateForm'); ?>?idst=<?php echo $travaux->id; ?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-edit"></i></a></td>
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