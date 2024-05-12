<?php if(!isset($ventes)) $ventes = array();?>
<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Graphe</h3>
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
		    <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Pack <small>repartition des montants</small></h2>
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
                        <canvas id="piechart" width="250" height="125"></canvas>
                    </div>
                    <script>
                        var config = {
                            type: 'pie',
                            data: {
                                datasets: [{
                                    data: [],
                                    backgroundColor: [],
                                }],
                                labels: []
                            },
                            options: {
                                responsive: true
                            }
                        };

                        <?php foreach ($ventes as $vente): ?>
                            config.data.datasets[0].data.push(<?php echo $vente->montant; ?>);
                            config.data.labels.push("<?php echo $vente->nom; ?>");
                            config.data.datasets[0].backgroundColor.push('<?php echo "rgba(" . rand(0, 255) . ", " . rand(0, 255) . ", " . rand(0, 255) . ", 0.5)"; ?>');
                        <?php endforeach; ?>

                        window.onload = function() {
                            var ctx = document.getElementById("piechart").getContext("2d");
                            window.myPie = new Chart(ctx, config);
                        };
                    </script>

                  </div>
                </div>
              </div>	
			</div>
		</div>
	</div>
<!-- /page content -->
