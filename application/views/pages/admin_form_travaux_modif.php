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
									<h2>Travaux <small>modification</small></h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
                                    <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url('CTL_Travaux/travauxModif'); ?>">
										<input type="hidden" class="form-control" name="idst" value="<?php echo $idst; ?>">
										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Code</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="text" class="form-control" name="code" value="<?php echo $travaux->code; ?>">
											</div>
										</div>
                                        <div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Designation</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="text" class="form-control" name="designation" value="<?php echo $travaux->designation; ?>">
											</div>
										</div>
										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Unité</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="text" class="form-control" name="unite" value="<?php echo $travaux->unite; ?>">
											</div>
										</div>
										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Prix Unitaire</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="number" min="0" class="form-control" name="pu" value="<?php echo $travaux->pu; ?>">
											</div>
										</div>
										<div class="x_content">
											<button type="submit" class="btn btn-success">Modifier</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /page content -->