<?php
$city="";
if(isset($_POST['location']))
{
	?>
	<script>
	navigator.geolocation.getCurrentPosition((position) => {
  console.log(position);
  console.log(position.coords.longitude);
  window.location.href='index.php?lat='+position.coords.latitude+'&long='+position.coords.longitude;
		});
		
  
	</script>
	<?php
	
}
else if(isset($_GET['lat']))
{
	$lat=$_GET['lat'];
	$long=$_GET['long'];
	$content=file_get_contents("https://us1.locationiq.com/v1/reverse.php?key=pk.73de96a25a2ffb7359ccc5eeaf0dd575&lat=" .
    $lat."&lon=".$long."&format=json");
	
	$arr=json_decode($content,true);
	
	$city= $arr['address']['city'];
	$url="http://api.openweathermap.org/data/2.5/weather?q=$city&appid=d402a2b7d7c46eb3c3d5805e6be7aa91";
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	$result=curl_exec($ch);
	$result=json_decode($result,true);
	if($result['cod']!=200)
	{
		$city='';
		?>
		<script>
		alert("City Not Found");
		</script>
		<?php
	}
}
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
		?>
		<script>
		alert("City Not Found");
		</script>
		<?php
	}
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.3.js"></script>
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
		.colophon
		{
			text-align:center;
		}
		#location
		{
			display:flex;
			justify-content:center;
		}
		#loc_div
		{
			
			margin-bottom:70%;
			flex-wrap:wrap;
			
		}
		.row{
				width:100%;
				margin-left:-5%;
				display:flex;
				justify-content:center;
				text-align:center;
		}
		.fa
		{
			line-height:2.5;
		}
		.social-links a{
			margin:2%;
		}
		.site-footer .social-links a
		{
			width:50px;
			height:50px;
		}
		</style>
	</head>


	<body>
		
		<div class="site-content">
			<div class="site-header">
				<div class="container">
					<a href="index.php" class="branding">
						<img src="images/logo.png" alt="" class="logo">
						<div class="logo-type">
							<h1 class="site-title">Mayank</h1>
							<h1 class="site-description">Accurate Weather</h1>
						</div>
					</a>
				</div>
			</div> <!-- .site-header -->

			<div class="hero" data-bg-image="https://images.unsplash.com/photo-1592210454359-9043f067919b?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8d2VhdGhlcnxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&w=1000&q=80">
				<div class="container">
					<form action="index.php" method="post" class="find-location">
						<input type="text" name="city" placeholder="Enter Location...">
						<input type="submit" name='submit'>
					</form>
					<div id="location"><form action="index.php" method="post"><input type="submit" name='location' value="Use your current location" id="loc_div"></form></div>
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
				
					<div class="row">
						
						<div class="col-md-3 col-md-offset-1">
							<div class="social-links">
								<a href="https://github.com/Mayankgupta-coder" target='_blank'><i class="fa fa-github"></i></a>
								<a href="https://www.linkedin.com/in/mayank-gupta-b8996716b/" target='_blank'><i class="fa fa-linkedin"></i></a>
							</div>
							<br/>
							<p class="colophon">Created By Mayank Gupta</p>
						</div>
					</div>

			</footer> <!-- .site-footer -->
		</div>
		
		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/plugins.js"></script>
		<script src="js/app.js"></script>
		
	</body>

</html>