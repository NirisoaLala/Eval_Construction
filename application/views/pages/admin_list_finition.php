<?php if(!isset($finitionList)) $finitionList = array(); ?>
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
                                <h2>Type de finition <small>liste</small></h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<table class="table">
                                        <thead>
                                          <tr>
                                            <th>Nom</th>
                                            <th>Pourcentage (%)</th>
											<th></th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($finitionList as $finition){ ?>
                                          <tr>
                                            <td><?php echo $finition->nom; ?></td>
                                            <td><?php echo $finition->pourcentage; ?></td>
											<td><a href="<?php echo site_url('CTL_Finition/updateForm'); ?>?idf=<?php echo $finition->id; ?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-edit"></i></a></td>
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