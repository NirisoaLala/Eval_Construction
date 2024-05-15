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
									<h2>Devis <small>demande</small></h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
                                    <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url('CTL_DevisClient/devisClient'); ?>">
                                        <div class="form-group row ">
										
												<div class="x_content">
												<ul class="list-unstyled timeline">
												<?php foreach($maisonList as $maison){ ?>
													<li>
													<div class="block">
														<div class="tags">
														<input type="radio" class="flat" name="maison" value="<?php echo $maison->id; ?>">
														</div>
														<div class="block_content">
														<h2 class="title">
																		<a><?php echo $maison->nom; ?></a>
																	</h2>
														<div class="byline">
															<span>Durée : <?php echo $maison->duree; ?> Jours - Ar <?php echo number_format($maison->montant, 2, '.', ' '); ?></span>
														</div>
														<p class="excerpt"><?php echo $maison->description; ?></br>Surface : <?php echo $maison->surface; ?> m2
														</p>
														</div>
													</div>
													</li>
												<?php } ?>
												</ul>

												</div>
											
										</div>
										<div class="form-group row">
											<label class="control-label col-md-3 col-sm-3 ">Finition</label>
											<div class="col-md-9 col-sm-9 ">
											<?php foreach($finitionList as $finition){ ?>
												<div class="col-md-3 col-sm-3 ">
                                            	<input type="radio" class="flat" name="finition" value="<?php echo $finition->id; ?>" /> <?php echo $finition->nom; ?>
												</div>
											<?php } ?>
											</div>
										</div>
                                        <div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Début des travaux</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="date" class="form-control" name="datedebut">
											</div>
										</div>
                                        <div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Création du devis</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="date" class="form-control" name="datecreation">
											</div>
										</div>
										<div class="form-group row ">
											<label class="control-label col-md-3 col-sm-3 ">Lieu</label>
											<div class="col-md-9 col-sm-9 ">
												<input type="text" class="form-control" name="lieu" placeholder="Lieu">
											</div>
										</div>
										<div class="x_content">
											<button type="submit" class="btn btn-success">Valider</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /page content -->