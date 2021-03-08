<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<title>{title}</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="X-UA-Compatible" content="IE=11">
	<meta http-equiv="X-UA-Compatible" content="IE=8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" /> -->
	<link href="<?=base_url()?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?=base_url()?>assets/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?=base_url()?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?=base_url()?>assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->

	{css_entries}
		<link href="{css_link}" rel="stylesheet" type="text/css" /> 
	{/css_entries}
	<!-- END PAGE LEVEL PLUGIN STYLES -->
	<!-- BEGIN THEME STYLES -->
	<link href="<?php echo base_url(); ?>assets/css/style-conquer.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url(); ?>assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url(); ?>assets/css/plugins.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url(); ?>assets/css/pages/portfolio.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url(); ?>assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet" type="text/css"/>
	<!-- END THEME STYLES -->
	<style type="text/css">
		#myModal{
			    display: none;
		}
		{css_custom}
	</style>
    
</head>
<body class="page-header-fixed page-sidebar-closed">
	<!-- Top Navigation 
	================================================== -->
	<?php $this->load->view("template/page-nav-v1.php"); ?>
	<!-- end #top-navigation -->
	<div class="clearfix">
	</div>
	<div class="page-container">
		<!-- Sidebar 
		================================================== -->
		<?php $this->load->view("template/page-sidebar.php"); ?>
		<!-- end #sidebar -->
		
		<!-- Content 
		================================================== -->
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content-wrapper">
				<div class="page-content">
					<?php
						$this->load->view($page);			
					?>	
				</div>
			</div>
		</div>	
		<!-- end #content -->
	</div>
	<div class="footer">
		<div class="footer-inner">
			2019 &copy; CISIT.
		</div>
		<div class="footer-tools">
			<span class="go-top">
				<i class="fa fa-angle-up"></i>
			</span>
		</div>
	</div>
    
	<!-- ================== GLOBAL PLUGINS START ================== -->
	<script src="<?php echo base_url(); ?>assets/plugins/jquery-1.11.0.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/jquery-migrate-1.2.1.min.js"></script>
	<!-- ================== GLOBAL PLUGINS START ================== -->
	<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/jquery.cokie.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	{js_plug}
		<script src="{js_link}" type="text/javascript"></script>
	{/js_plug}
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	{js_entries}
		<script src="{js_link}" type="text/javascript"></script>
	{/js_entries}
	<!-- END PAGE LEVEL SCRIPTS -->

	<!-- Application Setting -->
	<script src="<?php echo base_url(); ?>assets/scripts/app.js" type="text/javascript"></script>
	<script>
		$(document).ready(function() {
			App.init();
			{js_init}
		});
	</script>
	<script type="text/javascript">
		{js_custom}
	</script>
</body>
</html>