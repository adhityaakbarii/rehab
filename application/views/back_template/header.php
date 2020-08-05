<!DOCTYPE html>
<html dir="ltr" lang="en">
<base href="<?php echo base_url(); ?>" />
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">	
	<link rel="icon" type="image/png" sizes="16x16" href="assets/back/assets/images/">
	<?php $r = $this->m_admin->kondisi('rh_setting','id_setting=1')->row();  ?>
	<title><?php echo $r->nama_perusahaan ?></title>    	
	<link href="assets/back/assets/libs/flot/css/float-chart.css" rel="stylesheet">	
	<link href="assets/back/dist/css/style.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/back/assets/extra-libs/multicheck/multicheck.css">	
	<link href="assets/back/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">	
	<link rel="stylesheet" type="text/css" href="assets/back/assets/libs/select2/dist/css/select2.min.css">
	<link rel="stylesheet" type="text/css" href="assets/back/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<link href="assets/back/assets/libs/jquery-steps/jquery.steps.css" rel="stylesheet">
  <link href="assets/back/assets/libs/jquery-steps/steps.css" rel="stylesheet">
  <link href="assets/back/dist/css/style.min.css" rel="stylesheet">
	<style type="text/css">
		body {			
			zoom: 80%;
		}
	</style>
</head>
<?php 
function mata_uang($a){      
	if(is_numeric($a) AND $a != 0 AND $a != ""){
		return number_format($a, 0, ',', '.');
	}else{
		return $a;
	}
}

?>
<body>
	<!-- ============================================================== -->
	<!-- Preloader - style you can find in spinners.css -->
	<!-- ============================================================== -->
	<div class="preloader">
		<div class="lds-ripple">
			<div class="lds-pos"></div>
			<div class="lds-pos"></div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- Main wrapper - style you can find in pages.scss -->
	<!-- ============================================================== -->
	<div id="main-wrapper">
		<!-- ============================================================== -->
		<!-- Topbar header - style you can find in pages.scss -->
		<!-- ============================================================== -->
		<header class="topbar" data-navbarbg="skin5">
			<nav class="navbar top-navbar navbar-expand-md navbar-dark">
				<div class="navbar-header" data-logobg="skin5">
					<!-- This is for the sidebar toggle which is visible on mobile only -->
					<a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
					<!-- ============================================================== -->
					<!-- Logo -->
					<!-- ============================================================== -->
					<a class="navbar-brand" href="back/home">
						<!-- Logo icon -->
						<b class="logo-icon p-l-1">
							<!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
							<!-- Dark Logo icon -->
							<!-- <img src="assets/back/assets/images/favicon2.png" width="40%" alt="homepage" class="light-logo p-b-1" /> -->
							
						</b>
						<!--End Logo icon -->
						<!-- Logo text -->
						<span class="logo-text">
							<!-- dark Logo text -->                             
							<div style="margin-left: 0px;">
								<?php echo $r->nama_perusahaan  ?>
							</div>
							
						</span>
						<!-- Logo icon -->
						<!-- <b class="logo-icon"> -->
							<!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
							<!-- Dark Logo icon -->
							<!-- <img src="assets/back/assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->
							
							<!-- </b> -->
							<!--End Logo icon -->
						</a>
						<!-- ============================================================== -->
						<!-- End Logo -->
						<!-- ============================================================== -->
						<!-- ============================================================== -->
						<!-- Toggle which is visible on mobile only -->
						<!-- ============================================================== -->
						<a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
					</div>
					<!-- ============================================================== -->
					<!-- End Logo -->
					<!-- ============================================================== -->
					<div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">						
						<ul class="navbar-nav float-left mr-auto">
							<li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>							
							<span class="db"><img style="padding-top: 5px;" src="assets/back/assets/images/pemda.png" width="50px" alt="logo" /></span>
							<span class="db"><img style="padding-top: 5px;" src="assets/back/assets/images/bnn.png" width="50px" alt="logo" /></span>
							<span class="db"><img style="padding-top: 5px;" src="assets/back/assets/images/polda.png" width="50px" alt="logo" /></span>
							<span class="db"><img style="padding-top: 5px;" src="assets/back/assets/images/kemenkumham.png" width="50px" alt="logo" /></span>							
						</ul>						
						<ul class="navbar-nav float-right">							
						</li>                    
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/back/assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>
							<div class="dropdown-menu dropdown-menu-right user-dd animated">
								<!-- <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>                                 -->
								<a href="back/logout" class="dropdown-item" href="javascript:void(0)"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>                                
							</div>
						</li>
						<!-- ============================================================== -->
						<!-- User profile and search -->
						<!-- ============================================================== -->
					</ul>
				</div>
			</nav>
		</header>
		
		
		