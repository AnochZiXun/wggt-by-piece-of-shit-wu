<!DOCTYPE html>
<html lang="zh-Hant" class="js">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Content-Language" content="zh-tw" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Fav Icon  -->
	<link rel="apple-touch-icon" sizes="57x57" href="images/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="images/favicon//apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/favicon//apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="images/favicon//apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/favicon//apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="images/favicon//apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="images/favicon//apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="images/favicon//apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="images/favicon//apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="images/favicon//android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="images/favicon//favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="images/favicon//favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="images/favicon//favicon-16x16.png">
	<link rel="manifest" href="images/favicon//manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="images/favicon//ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<!-- Site Title  -->
	<title>WGGT - WIND GREEN GAIN TOKEN</title>
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:300,400,500,700" rel="stylesheet">
	<!-- Vendor Bundle CSS -->
	<link rel="stylesheet" href="assets/css/vendor.bundle.css?ver=132">
	<!-- Custom styles for this template -->
	<link rel="stylesheet" href="assets/css/style.css?ver=132">
	<link rel="stylesheet" href="assets/css/theme.css?ver=132">
	
</head>

<body class="theme-light io-jasmine" data-spy="scroll" data-target="#mainnav" data-offset="80">

	<!-- Header --> 
	<header class="site-header is-sticky">
		<!-- Navbar -->
		<div class="navbar navbar-expand-lg is-transparent" id="mainnav">
			<nav class="container">

				<a class="navbar-brand animated" data-animate="fadeInDown" data-delay=".65" href="./">
					<img class="logo logo-dark" alt="logo" src="images/logo.png" srcset="images/logo2x.png 2x">
					<img class="logo logo-light" alt="logo" src="images/logo-white.png" srcset="images/logo-white2x.png 2x">
				</a>

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggle">
					<span class="navbar-toggler-icon">
						<span class="ti ti-align-justify"></span>
					</span>
				</button>
<?php
require('menu.php') ;
?>
			</nav>
		</div>
		<!-- End Navbar -->
		
		<!-- Banner -->
		<div id="header" class="page-banner d-flex align-items-center">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="page-head">
							<h2 class="page-heading">會員後臺管理</h2>
						</div>
					</div>
					<div class="page-head-image">
						<img src="images/page-head-image-a.png" alt="page-head">
					</div>
				</div>
			</div><!-- .container  -->
		</div>
		<!-- End Banner -->
	</header>
	<!-- End Header -->

	<!-- Start Section -->
	<div class="section section-pad-md section-bg-alt blog-section">
		<div class="container">
			<div class="row">
<?php
require('member_menu.php') ;
?>
				<div class="col-lg-10 table-responsive" style="border-right: 1px solid lightgrey;">
					<div class="input-border-simple"><h5><strong>我的風利幣錢包地址：</strong>wgceim1j8cm0621015335wc059oyyr</h5></div>
					<div class="gaps size-1x"></div>
					<form name="form" action="buy.php" method="post">
						<div class="form-group col-md-12">
							<label>官方收款以太錢包地址</label>
							<input type="text" name="eth_address" value="0x751c8f23812144324de1d5e4bc7232d7fff0e2c7" class="form-control" readonly> 
						</div>
						<div class="form-group col-md-12">
							<label>您的以太幣</label>
							<div class="row">
								<div class="form-group col-md-6">
									<input type="text" name="eth_address" placeholder="請輸入您的以太幣地址" class="form-control">
								</div>
								<div class="form-group col-md-6">
									<input type="text" name="eth"  placeholder="以太幣數量" class="form-control"> 
								</div>
								<div class="form-group col-md-12">
									<input type="text" name="wgc"  placeholder="風利幣數量" class="form-control"> 
								</div>
								<input type="hidden" name="wgc_change" value="400" />
								<input type="hidden" name="buy_wgc" />
							</div>
						</div>
						<div class="col-xs-12"><button type="submit" class="btn-default btn btn-block col-md-5">確認送出</button></div>		
					</form>							
				</div><!-- .col -->
			</div><!-- .row -->
		</div><!-- .container -->
	</div>
	<!-- Start Section -->

	<!-- Start Section -->
<?php
require('contact.php') ;
?>
	<!-- End Section -->

	<!-- Start Section -->
	<div class="section footer-scetion footer-jasmine">
		<div class="container">
			<div class="row text-center">
				<div class="col-md-12">
					<ul class="social">
						<li class="animated" data-animate="fadeInUp" data-delay=".1"><a href="#"><em class="fab fa-facebook-f"></em></a></li>
						<li class="animated" data-animate="fadeInUp" data-delay=".2"><a href="#"><em class="fab fa-twitter"></em></a></li>
						<li class="animated" data-animate="fadeInUp" data-delay=".3"><a href="#"><em class="fab fa-youtube"></em></a></li>
					</ul>
					<a href="index.html" class="footer-logo"><img src="images/logo.png" alt="logo2x" srcset="images/logo2x.png 2x"></a>
					<span class="copyright-text">
						Copyright &copy; 2018, Rich Star Group Co, Ltd. 版權所有 All Rights Reserved.
					</span>
				</div>
			</div>
		</div>
	</div>
	<!-- End Section -->

	<!-- Preloader !remove please if you do not want -->
	<div id="preloader">
		<div id="loader"></div>
		<div class="loader-section loader-top"></div>
   		<div class="loader-section loader-bottom"></div>
	</div>
	<!-- Preloader End -->

	<!-- JavaScript (include all script here) -->
	
	<script src="assets/js/jquery.bundle.js?ver=132"></script>
	<script src="assets/js/script.js?ver=132"></script>
	<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
	<script>
	$('.grid').masonry({
	  // options
	  itemSelector: '.grid-item',
	});
	</script>

</body>
</html>
