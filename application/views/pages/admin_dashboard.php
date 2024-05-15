<?php if(!isset($dashList)) $dashList = array(); ?>
          <!-- page content -->
      <div class="right_col" role="main">
        <div class="row" style="display: inline-block;" >
          <div class="tile_count">
            <div class="col-md-7 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-calculator"></i> Montant Total des devis</span>
              <div class="count"><?php echo number_format($montant->montant_devis, 2, '.', ' '); ?></div>
            </div>
            <div class="col-md-5 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-calculator"></i> Montant Total des paiement</span>
              <div class="count"><?php echo number_format($paiement->paiement, 2, '.', ' '); ?></div>
            </div>
          </div>
		</div>
        <div class="row">
			<div class="col-md-12 ">
				<div class="x_panel">
					<div class="x_title">
						<h2>Année <small>sélection</small></h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<br />
                        <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url('CTL_DevisAdmin/getDash'); ?>">
							<div class="form-group row">
								<label class="control-label col-md-3 col-sm-3 ">Année</label>
								<div class="col-md-9 col-sm-9 ">
                                    <input type="number" class="form-control" placeholder="Entrer l'année" name="annee">
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
            <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                  <div class="x_title">
                    <h2>Devis <small>par an</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                          </div>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="canvas-holder half">
                        <canvas id="canvas" width="250" height="125"></canvas>
                    </div>
                    <script>
                    var labels = [];
                    var data = [];
                    <?php foreach ($dashList as $row): ?>
                        labels.push('<?php echo $row->mois; ?>');
                        data.push(<?php echo $row->montant; ?>);
                    <?php endforeach; ?>
                    window.onload = function() {
                        var ctx = document.getElementById("canvas").getContext("2d");
                        window.myBar = Chart.Bar(ctx, {
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Montant Total des Devis',
                                    backgroundColor: "rgba(220,220,220,0.5)",
                                    data: data
                                }]
                            },
                            options: {
                                responsive: true,
                                hoverMode: 'label',
                                hoverAnimationDuration: 400,
                                stacked: false,
                                title: {
                                    display: true,
                                    text: "Montant Total des Devis par Mois"
                                },
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                    };

                    </script>

                  </div>
                </div>
            </div>

          </div>
    </div>
			<!-- /page content -->