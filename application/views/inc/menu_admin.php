<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">
					<div class="navbar nav_title" style="border: 0;">
						<a href="index.html" class="site_title"><img src=<?php echo base_url("assets/docs/images/logo.jpg"); ?> alt="..." class="sary"> <span>Construction</span></a>
					</div>

					<div class="clearfix"></div>

					<!-- menu profile quick info -->
					<div class="profile clearfix">
						<div class="profile_pic">
							<img src=<?php echo base_url("assets/docs/images/images.png"); ?> alt="..." class="img-circle profile_img">
						</div>
						<div class="profile_info">
							<span>Welcome,</span>
							<h2>John Doe</h2>
						</div>
					</div>
					<!-- /menu profile quick info -->

					<br />

					<!-- sidebar menu -->
					<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
						<div class="menu_section">
							<h3>General</h3>
							<ul class="nav side-menu">
								<li><a><i class="fa fa-edit"></i> Formulaire <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="<?php echo site_url('CTL_User/reinit'); ?>">Réinitialisation de données</a></li>
										<li><a href="<?php echo site_url('CTL_DevisAdmin/donneesPage'); ?>">Données Import</a></li>
										<li><a href="<?php echo site_url('CTL_DevisAdmin/paiePage'); ?>">Paiement Import</a></li>
									</ul>
								</li>
								<li><a><i class="fa fa-table"></i> Listes <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
									  <li><a href="<?php echo site_url('CTL_DevisAdmin/listDevis'); ?>">Devis en cours</a></li>
									  <li><a href="<?php echo site_url('CTL_Travaux/'); ?>">Travaux</a></li>
									  <li><a href="<?php echo site_url('CTL_Finition/'); ?>">Type de finition</a></li>
									</ul>
								</li>
                            	<li><a><i class="fa fa-desktop"></i> Chart <span class="fa fa-chevron-down"></span></a>
                            	    <ul class="nav child_menu">
										<li><a href="<?php echo site_url('CTL_DevisAdmin/dashboard'); ?>">Tableau de bord</a></li>
                            	    </ul>
                            	</li>
							</ul>
						</div>

					</div>
					<!-- /sidebar menu -->

					<!-- /menu footer buttons -->
					<div class="sidebar-footer hidden-small">
						<a data-toggle="tooltip" data-placement="top" title="Settings">
							<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
						</a>
						<a data-toggle="tooltip" data-placement="top" title="FullScreen">
							<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
						</a>
						<a data-toggle="tooltip" data-placement="top" title="Lock">
							<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
						</a>
						<a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo site_url('CTL_User/deconnexionAdmin'); ?>">
							<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
						</a>
					</div>
					<!-- /menu footer buttons -->
				</div>
			</div>

			<!-- top navigation -->
			<div class="top_nav">
				<div class="nav_menu">
					<div class="nav toggle">
						<a id="menu_toggle"><i class="fa fa-bars"></i></a>
					</div>
					<nav class="nav navbar-nav">
						<ul class=" navbar-right">
							<li class="nav-item dropdown open" style="padding-left: 15px;">
								<a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
									<img src="<?php echo base_url("assets/docs/images/images.png"); ?>" alt="">John Doe
								</a>
								<div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="<?php echo site_url('CTL_User/deconnexionAdmin'); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
								</div>
							</li>
						</ul>
					</nav>
				</div>
			</div>
			<!-- /top navigation -->
