<!DOCTYPE html>

<html lang="en" class="no-js">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <head>
        <meta charset="utf-8"/>
        <title>{page_title}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="X-UA-Compatible" content="IE=11">
        <meta http-equiv="X-UA-Compatible" content="IE=8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <meta name="MobileOptimized" content="320">
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="<?=base_url()?>/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url()?>/assets/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url()?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url()?>/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>

        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/plugins/select2/select2.css"/>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME STYLES -->
        <link href="<?=base_url()?>/assets/css/style-conquer.css" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url()?>/assets/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url()?>/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url()?>/assets/css/plugins.css" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url()?>/assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
        <link href="<?=base_url()?>/assets/css/pages/login.css" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url()?>/assets/css/custom.css" rel="stylesheet" type="text/css"/>
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="<?=base_url()?>/favicon.html"/>
        <style type="text/css">
            .no-js #loader { display: none;  }
            .js #loader { display: block; position: absolute; left: 100px; top: 0; }
            .se-pre-con {
                position: fixed;
                left: 0px;
                top: 0px;
                width: 100%;
                height: 100%;
                z-index: 9999;
                background: url(<?=base_url()?>/assets/img/Preloader_8.gif) center no-repeat #fff;
            }
        </style>
    </head>
    <!-- BEGIN BODY -->
    <body class="login">
        <!-- hide the page if it wasn't completely loaded -->
        <div class="se-pre-con"></div> 
        <!-- BEGIN LOGO -->
        <div class="logo">
            
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            

            <form class="login-form" action="<?=base_url()?>/register" method="post" accept-charset="utf-8">
                <div>
                    <img src="<?=base_url()?>/assets/img/logo.png" alt="logo" class="img-responsive" width="100"
                    style="margin-left: auto; margin-right: auto; display: block;"/>
                  
                </div>
                <h3 class="form-title">Registration</h3>
                <?php 
                    if(isset($validation)):?>
                    <div class="alert alert-danger">
                        <button class="close" data-close="alert"></button>
                        <span>
                        <?= $validation->listErrors()?>
                        </span>
                    </div>
                <?php elseif($has_error): ?>
                    <div class="alert alert-danger">
                        <button class="close" data-close="alert"></button>
                        <span>
                        <?= $error_msg['err_msg']?>
                        </span>
                    </div>
                <?php endif?>
                <div class="alert alert-error display-hide">
                    <button class="close" data-close="alert"></button>
                    <span>
                        Enter any ID no. and password.
                    </span>
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Activation Code</label>
                    <div class="input-icon">
                        <i class="fa fa-key"></i>
                        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Activation Code" name="activation_code"  value='<?=set_value('activation_code') ?>'/>
                    </div>
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Member ID</label>
                    <div class="input-icon">
                        <i class="fa fa-barcode"></i>
                        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Member ID" name="member_id"  value='<?=set_value('member_id') ?>'/>
                    </div>
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username"  value='<?=set_value('username') ?>'/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" id="password"  value='<?=set_value('password') ?>'/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Confirm Password</label>
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Confirm Password" name="confirm_password"  value='<?=set_value('confirm_password') ?>'/>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-info pull-right">
                    Register </button>
                </div>
            </form>
            
        </div>
        <!-- END LOGIN -->
        <!-- BEGIN COPYRIGHT -->
        <div class="copyright">
        2021 &copy; Rayns Marketing & <a href="https://www.facebook.com/jeepny.ako/" style="color: #ff5f5f;">JD Tonido</a>.
        </div>
        <!-- END COPYRIGHT -->
        <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
        <!-- BEGIN CORE PLUGINS -->
        <!--[if lt IE 9]>
        <script src="assets/plugins/respond.min.js"></script>
        <script src="assets/plugins/excanvas.min.js"></script> 
        <![endif]-->
        <script src="<?=base_url()?>/assets/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>/assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>/assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>/assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>/assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?=base_url()?>/assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?=base_url()?>/assets/plugins/select2/select2.min.js"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?=base_url()?>/assets/scripts/app.js" type="text/javascript"></script>
        <script src="<?=base_url()?>/assets/scripts/registration.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <script>
            jQuery(document).ready(function() {     
                // App.init();
                Login.init();
            });
            $(window).load(function() {
                // Animate loader off screen
                $(".se-pre-con").fadeOut("slow");;
            });
        </script>
    </body>
<!-- END JAVASCRIPTS -->
</html>