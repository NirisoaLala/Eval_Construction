<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Construction | </title>

    <!-- Bootstrap -->
    <link href= <?php echo base_url("assets/vendors/bootstrap/dist/css/bootstrap.min.css"); ?>  rel="stylesheet">
    <!-- Font Awesome -->
    <link href= <?php echo base_url("assets/vendors/font-awesome/css/font-awesome.min.css"); ?> rel="stylesheet">
    <!-- NProgress -->
    <link href=<?php echo base_url("assets/vendors/nprogress/nprogress.css"); ?> rel="stylesheet">
    <!-- Animate.css -->
    <link href=<?php echo base_url("assets/vendors/animate.css/animate.min.css"); ?> rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href=<?php echo base_url("assets/build/css/custom.min.css"); ?> rel="stylesheet">
    <link href="<?php echo base_url("assets/build/css/style.css"); ?>" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action = "<?php echo site_url("CTL_User/login") ?>" method = "post">
              <h1>Login Form</h1>
              <?php if ($this->session->flashdata('error')) { ?>
                  <div class="alert alert-danger alert-dismissible" role="alert">
                      <?php echo $this->session->flashdata('error');?>
                  </div>
              <?php } ?>
              <div>
                <input type="email" name="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" name="mdp" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <button type="submit" class="btn btn-default submit">Log in</button>
                <a class="reset_pass" href="<?php echo site_url("CTL_User/index") ?>">Customer</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <?php if(isset($error)){ ?>
                <div class="alert alert-danger alert-dismissible " role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <?php echo $error ?> 
                </div>
                <?php } ?>

                <div>
                  <h1><img src=<?php echo base_url("assets/docs/images/logo.jpg"); ?> alt="..." class="sary"> Construction</h1>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><img src=<?php echo base_url("assets/docs/images/logo.jpg"); ?> alt="..." class="sary"> Construction</h1>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
