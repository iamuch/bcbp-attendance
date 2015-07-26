<?php if(!Configure::read('Application.maintenance')){?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<?php echo $this->Html->link(
			Configure::read('Application.name'),
			AuthComponent::user('id') ? "/home" : "/"
			, array('class' => 'navbar-brand')) ?>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse navbar-ex1-collapse">

		<?php if(AuthComponent::user('id')){?>
			<ul class="nav navbar-nav side-nav">
				<li class="<?php echo $this->params->params['controller'] == 'pages' ? 'active' : ''?>"><a href="<?php echo $this->params->webroot?>home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li class="menu"><a href="#"><i class="fa fa-wrench"></i> SETTINGS</a></li>
				<li class="dropdown <?php echo $this->params->params['controller'] == 'users' ? 'active' : ''?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa"></i> Users <b
							class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo $this->params->webroot?>users"><i class="fa fa-list"></i> List</a></li>
						<li><a href="<?php echo $this->params->webroot?>users/add"><i class="fa fa-plus"></i> Register new user</a></li>
					</ul>
				</li>
				<li class="dropdown <?php echo $this->params->params['controller'] == 'profile' ? 'active' : ''?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa"></i> Profile <b
							class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo $this->params->webroot?>profile"><i class="fa fa-list"></i> List</a></li>
						<li><a href="<?php echo $this->params->webroot?>profile/add"><i class="fa fa-plus"></i> Add New Profile</a></li>
					</ul>
				</li>
				<li class="dropdown <?php echo $this->params->params['controller'] == 'regions' ? 'active' : ''?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa"></i> Region <b
							class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo $this->params->webroot?>regions"><i class="fa fa-list"></i> List</a></li>
						<li><a href="<?php echo $this->params->webroot?>regions/add"><i class="fa fa-plus"></i> Add New Region</a></li>
					</ul>
				</li>
				<li class="dropdown <?php echo $this->params->params['controller'] == 'units' ? 'active' : ''?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa"></i> Unit <b
							class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo $this->params->webroot?>units"><i class="fa fa-list"></i> List</a></li>
						<li><a href="<?php echo $this->params->webroot?>units/add"><i class="fa fa-plus"></i> Add New Unit</a></li>
					</ul>
				</li>
				<li class="dropdown <?php echo $this->params->params['controller'] == 'actionGroups' ? 'active' : ''?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa"></i> Action Group <b
							class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo $this->params->webroot?>actionGroups"><i class="fa fa-list"></i> List</a></li>
						<li><a href="<?php echo $this->params->webroot?>actionGroups/add"><i class="fa fa-plus"></i> Add New Action Group</a></li>
					</ul>
				</li>
				<li class="dropdown <?php echo $this->params->params['controller'] == 'activity' ? 'active' : ''?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa"></i> Activity <b
							class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo $this->params->webroot?>activity"><i class="fa fa-list"></i> List</a></li>
						<li><a href="<?php echo $this->params->webroot?>activity/add"><i class="fa fa-plus"></i> Add New Activity</a></li>
					</ul>
				</li>
				<li class="dropdown <?php echo $this->params->params['controller'] == 'category' ? 'active' : ''?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa"></i> Category <b
							class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo $this->params->webroot?>category"><i class="fa fa-list"></i> List</a></li>
						<li><a href="<?php echo $this->params->webroot?>category/add"><i class="fa fa-plus"></i> Add New Category</a></li>
					</ul>
				</li>
				<li class="dropdown <?php echo $this->params->params['controller'] == 'service' ? 'active' : ''?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa"></i> Service <b
							class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo $this->params->webroot?>service"><i class="fa fa-list"></i> List</a></li>
						<li><a href="<?php echo $this->params->webroot?>service/add"><i class="fa fa-plus"></i> Add New Service</a></li>
					</ul>
				</li>
<!--				<li><a href="tables.html"><i class="fa fa-list"></i> Activity</a></li>-->
			</ul>
		<?php } ?>



		<?php if(AuthComponent::user('id')){?>

		<ul class="nav navbar-nav navbar-right navbar-user">
			<li class="dropdown user-dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo AuthComponent::user('username')?> <b
						class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="<?php echo $this->params->webroot?>me"><i class="fa fa-user"></i> Profile</a></li>
					<li><a href="<?php echo $this->params->webroot?>me/edit"><i class="fa fa-gear"></i> Settings</a></li>
					<li class="divider"></li>
					<li><a href="<?php echo $this->params->webroot?>logout"><i class="fa fa-power-off"></i> Log Out</a></li>
				</ul>
			</li>
		</ul>
		<?php }?>
	</div>
	<!-- /.navbar-collapse -->
</nav>
<?php } ?>