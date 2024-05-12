<?php if(!isset($etulist)) $etulist = array(); 
      if(!isset($ventelist)) $ventelist = array();?>
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
									<h2>Etudiant <small>sélection</small></h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
                                    <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url('CT_Vente/list_vente'); ?>">

										<div class="form-group row">
											<label class="control-label col-md-3 col-sm-3 ">Etudiant</label>
											<div class="col-md-9 col-sm-9 ">
												<select class="form-control" name="etu">
                                                <?php foreach($etulist as $etu){ ?>
                                                    <option value="<?php echo $etu->id; ?>"><?php echo $etu->nom; ?></option>
                                                <?php } ?>
												</select>
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
                    <div class="row">
						<div class="col-md-12 ">
							<div class="x_panel">
								<div class="x_title">
                                <h2>Billet vendu <small>nombre et type</small></h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<table class="table">
                                        <thead>
                                          <tr>
                                            <th>Nom</th>
                                            <th>Pack</th>
                                            <th>Nombre</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($ventelist as $vente){ ?>
                                          <tr>
                                            <td><?php echo $vente->etu; ?></td>
                                            <td><?php echo $vente->pack; ?></td>
                                            <td><?php echo $vente->nombre; ?></td>
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