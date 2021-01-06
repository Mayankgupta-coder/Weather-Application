<?php
$city="";
if(isset($_POST['submit']))
{
	$city=$_POST['city'];
	$url="http://api.openweathermap.org/data/2.5/weather?q=$city&appid=d402a2b7d7c46eb3c3d5805e6be7aa91";
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$result=curl_exec($ch);
$result=json_decode($result,true);
if($result['cod']!=200)
{
	$city='';
}
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title>Weather Application</title>

		<!-- Loading third party fonts -->
		<link href="http://fonts.googleapis.com/css?family=Roboto:300,400,700|" rel="stylesheet" type="text/css">
		<link href="fonts/font-awesome.min.css" rel="stylesheet" type="text/css">

		<!-- Loading main css file -->
		<link rel="stylesheet" href="style.css">
		
		<!--[if lt IE 9]>
		<script src="js/ie-support/html5.js"></script>
		<script src="js/ie-support/respond.js"></script>
		<![endif]-->
		<style>
			.forecast-container .forecast.today .forecast-content {
        text-align: center;
        padding-top: 30px;
        padding-bottom: 30px; }
		</style>
	</head>


	<body>
		
		<div class="site-content">
			<div class="site-header">
				<div class="container">
					<a href="index.html" class="branding">
						<img src="images/logo.png" alt="" class="logo">
						<div class="logo-type">
							<h1 class="site-title">Mayank</h1>
							<small class="site-description">Accurate Weather</small>
						</div>
					</a>

					<!-- Default snippet for navigation -->
					<div class="main-navigation">
						<button type="button" class="menu-toggle"><i class="fa fa-bars"></i></button>
						<ul class="menu">
							<!-- <li class="menu-item current-menu-item"><a href="index.php">Home</a></li>
							<li class="menu-item"><a href="news.html">News</a></li>
							<li class="menu-item"><a href="live-cameras.html">Live cameras</a></li>
							<li class="menu-item"><a href="photos.html">Photos</a></li>
							<li class="menu-item"><a href="contact.html">Contact</a></li> -->
						</ul> <!-- .menu -->
					</div> <!-- .main-navigation -->

					<div class="mobile-navigation"></div>

				</div>
			</div> <!-- .site-header -->

			<div class="hero" data-bg-image="images/banner.png">
				<div class="container">
					<form action="index.php" method="post" class="find-location">
						<input type="text" name="city" placeholder="Find your location...">
						<input type="submit" name='submit'>
					</form>

				</div>
			</div>
			<?php if($city!=''){?>
			<div class="forecast-table">
				<div class="container">
					<div class="forecast-container">
						<div class="today forecast">
							<div class="forecast-header">
								<div class="day"><?php echo date('d M',$result['dt'])?></div>
								<!-- <div class="date">6 Oct</div> -->
							</div> <!-- .forecast-header -->
							<div class="forecast-content">
								<div class="location"><?php echo $result['name']?></div>
								<div class="degree">
									<div class="num"><?php echo round($result['main']['temp']-273.15) ?><sup>o</sup>C</div>
									<div class="forecast-icon">
										<img src="http://openweathermap.org/img/wn/<?php echo $result['weather'][0]['icon']?>@2x.png" alt="" width=90>
									</div>	
								</div>
								<h1><?php echo $result['weather'][0]['main']?></h1>
								<span><img src="images/icon-wind.png" alt=""><?php echo $result['wind']['speed'] ?></span>
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
			<footer class="site-footer">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<form action="#" class="subscribe-form">
								<input type="text" placeholder="Enter your email to subscribe...">
								<input type="submit" value="Subscribe">
							</form>
						</div>
						<div class="col-md-3 col-md-offset-1">
							<div class="social-links">
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-google-plus"></i></a>
								<a href="#"><i class="fa fa-pinterest"></i></a>
							</div>
						</div>
					</div>

					<p class="colophon">Copyright 2014 Company name. Designed by Themezy. All rights reserved</p>
				</div>
			</footer> <!-- .site-footer -->
		</div>
		
		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/plugins.js"></script>
		<script src="js/app.js"></script>
		
	</body>

</html>