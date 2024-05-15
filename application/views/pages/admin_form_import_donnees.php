<?php if(!isset($finitionList)) $finitionList = array();
      if(!isset($maisonList)) $maisonList = array(); ?>
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
									<h2>Données <small>import</small></h2>
									<div class="clearfix"></div>
								</div>
								<?php if (isset($_GET['error'])) { ?>
                                    <div class="x_content bs-example-popovers">
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <?php echo $_GET['error']; ?>
                                        </div>
                                    </div>
                                <?php } ?>
								<div class="x_content">
									<br />
                                    <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url('CTL_Travaux/importMaisonTravaux'); ?>" enctype="multipart/form-data">
                                        <div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Maison et Travaux</label>
											<div class="col-md-9 col-sm-9 ">
                                                <input type="file" class="form-control" name="filemt" >
											</div>
										</div>
                                        <div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Devis</label>
											<div class="col-md-9 col-sm-9 ">
                                                <input type="file" class="form-control" name="file" >
											</div>
										</div>
										<div class="x_content">
											<button type="submit" class="btn btn-success">Importer</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /page content -->