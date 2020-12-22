<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="description" content="Parker’s business process entry app. Powered by Spirit and Dexterity Logics.">
        <meta name="keywords" content="Parker's, Process Entry, Business">
        <meta name="author" content="Dexterity Logics, Spirit">
        <title><?php echo $title; ?></title>
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
		
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/library/daterangepicker-master/daterangepicker.css">
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">

        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>
	<body>
		<div class="container">
			<nav class="topnav navbar navbar-expand-lg navbar-light">
				<a href="record"><img src="<?php echo base_url();?>uploads/<?php echo $avatar ?>" class="headerimage navbar-brand"></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				
				<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
					<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
						<li class="navigation nav-item active">
							<a class="nav-link" href="#" id = "dashboard"> Dashboard </a>
						</li>
						<li class="navigation nav-item">
							<a class="nav-link" href="#" id = "records"> Record <span class="sr-only">(current)</span></a>
						</li>
						<li class="navigation nav-item">
							<a class="nav-link" href="#" id = "payroll">Payroll</a>
						</li>
						<li class="navigation nav-item">
							<a class="nav-link" href="#" id = "reports">Reports</a>
						</li>
						<?php
							if($role == 'Admin'){	
						?>							
						<li class="navigation nav-item">
							<a class="nav-link" href="#" id = "settings">Settings</a>
						</li>
						<?php
							}
						?>
                	</ul>
					<?php
						// echo '<div class = "username" style = "margin: 0 20px">Welcome, '.ucwords($firstname).'</div>';
					?>
                	<button class="signout" data-toggle="modal" data-target="#changePasswordModal">Change Password</button>
                	<button class="signout" id = "signout">Sign Out</button>
            	</div>
        	</nav>