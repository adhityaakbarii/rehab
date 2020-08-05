<!DOCTYPE html>
<html dir="ltr">
<base href="<?php echo base_url(); ?>" />

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">    
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">    
	<link rel="icon" type="image/png" sizes="16x16" href="assets/back/assets/images/favicon2.png">
	<title>S.I.M.B.A</title>    
	<link href="assets/back/dist/css/style.min.css" rel="stylesheet">   
</head>

<body>
	<div class="main-wrapper">        
		<div class="preloader">
			<div class="lds-ripple">
				<div class="lds-pos"></div>
				<div class="lds-pos"></div>
			</div>
		</div>        
		<div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
			<div class="auth-box bg-dark border-secondary" style="margin-top: 15px;">
				<div id="loginform">
					<div class="text-center p-t-5 p-b-5">
						<span class="db"><img style="padding-top: 5px;" src="assets/back/assets/images/pemda.png" width="50px" alt="logo" /></span>
						<span class="db"><img style="padding-top: 5px;" src="assets/back/assets/images/bnn.png" width="50px" alt="logo" /></span>
						<span class="db"><img style="padding-top: 5px;" src="assets/back/assets/images/polda.png" width="50px" alt="logo" /></span>
						<span class="db"><img style="padding-top: 5px;" src="assets/back/assets/images/kemenkumham.png" width="50px" alt="logo" /></span>							
					</div>
					<!-- Form -->
					<form class="form-horizontal m-t-20" method="post" id="loginform" action="back/login">
						<div class="row p-b-30">
							<div class="col-12">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
									</div>
									<input type="text" name="username" class="form-control form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required="">
								</div>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
									</div>
									<input type="password" name="password" class="form-control form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required="">
								</div>
								<div class="mb-2">      
									<div class="row row-sm">
									  <div class="col-5">                                    
										<span id="captImg"><?php echo $captchaImg; ?> </span>               
									</div>
									<!-- <a href="#" class="reload-captcha refreshCaptcha btn btn-info btn-sm" ><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><line x1="3" y1="12" x2="6" y2="12"></line><line x1="12" y1="3" x2="12" y2="6"></line><line x1="7.8" y1="7.8" x2="5.6" y2="5.6"></line><line x1="16.2" y1="7.8" x2="18.4" y2="5.6"></line><line x1="7.8" y1="16.2" x2="5.6" y2="18.4"></line><path d="M12 12l9 3l-4 2l-2 4l-3 -9"></path></svg></a>         -->
									<div class="col-7">                                                    
										<input autocomplete="off" type="text" id="kode" name="kode" required class="form-control"  placeholder="Masukkan Kode Keamanan" >                                            
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row border-top border-secondary">
						<div class="col-12">
							<div class="form-group">
								<div class="p-t-20">									
									<button class="btn btn-success float-right" type="submit">Login</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>                
		</div>
	</div>        
</div>    
<script src="assets/back/assets/libs/jquery/dist/jquery.min.js"></script>    
<script src="assets/back/assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="assets/back/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>    
<script>

	$('[data-toggle="tooltip"]').tooltip();
	$(".preloader").fadeOut();    
	$('#to-recover').on("click", function() {
		$("#loginform").slideUp();
		$("#recoverform").fadeIn();
	});
	$('#to-login').click(function(){
		
		$("#recoverform").hide();
		$("#loginform").fadeIn();
	});
</script>
<script>
	$(document).ready(function(){
		$('.refreshCaptcha').on('click', function(){
			$.get('<?php echo base_url().'back/refresh'; ?>', function(data){
				$('#captImg').html(data);
			});
		});
	});
</script>

</body>

</html>