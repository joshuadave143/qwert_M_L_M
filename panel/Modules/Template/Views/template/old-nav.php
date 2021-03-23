
	<div id="top-nav">
		<div class="navbar">
			<div class="navbar-inner">
				<a href="#" class="btn btn-navbar pull-right" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<ul class="nav pull-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-refresh"></i><span class="label label-info">5</span>
						</a>
						<?php if (count($notifications) > 0) : ?>
						<ul class="dropdown-menu">
							<?php 
								foreach ($notifications as $notif) : 
									echo nav_notification($notif);
								endforeach;
							?>
 							<li class="divider"></li>
							<li class="dropdown-footer"><a href="#"><span class="label"><i class="icon-circle-arrow-right"></i></span> View all updates</a></li>
						</ul>
						<?php endif; ?>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-envelope"></i>
						</a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-exclamation-sign"></i>
						</a>
					</li>
					<li class="divider-vertical"></li>
			  		<li class="dropdown">
			  			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			  				<img alt="" src="<?php echo base_url(); ?>/assets/img/user-profile-pic-0.png" /> <span class="hidden-phone"><?php echo $profile['username']; ?></span>
			  			</a>
			  			<ul class="dropdown-menu">
							<li><a href="user-profile"><i class="icon-user"></i> My Profile</a></li>
							<li><a href="#"><i class="icon-cogs"></i> Setting</a></li>
							<li class="divider"></li>
							<li><a href="logout"><i class="icon-signout"></i> Logout </a></li>
						</ul>
				</ul>
	<!-- 			<form class="navbar-search pull-right hidden-phone" />
				  	<input type="text" class="search-query" placeholder="Search" />
  					<button type="submit" class="btn"><i class="icon-search"></i></button>
				</form> -->
		  	</div><!-- end navbar inner -->
		</div><!-- end navbar -->
  	</div>