<?php
require_once("clientobjects.php");

$urlviewed = $_SERVER['REQUEST_URI'];
if (strpos($urlviewed, "?") > 0) {
  $urlend = strpos($urlviewed, "?");
  $urlviewed = substr($urlviewed, 0, $urlend);
}
$urlvisitors->saveOrUpdate($urlviewed);

$popupcookie = true;
$cookie_title = urlFormat($title);
if (!isset($_COOKIE[$cookie_title]))
  setcookie($cookie_title, "meroproperty", time() + (60 * 60 * 24));
else
  $popupcookie = false;
?>
<!doctype html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $pageTitle; ?></title>
	<meta name="keywords" content="<?php echo $pageKeyword; ?>">
	<meta name="description" content="<?php echo $pageDescription; ?>">
	
	<link rel="dns-prefetch" href="https://fonts.googleapis.com">
	<link rel="dns-prefetch" href="https://maxcdn.bootstrapcdn.com">
	
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/responsive-tabs.css" rel="stylesheet">
	<link href="css/owl.carousel.min.css" rel="stylesheet">	
	<link href="css/owl.theme.default.min.css" rel="stylesheet">
	<link href="css/ihover.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
  </head>

  <body>
	<header class="header">
	  <div class="top-navigation">
		<div class="container">
		  <div class="row">
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			  <ul class="login-panel">
				<li><a href="page/login<?php echo PAGE_EXTENSION; ?>">Sign In</a></li>
				<li><a href="page/register<?php echo PAGE_EXTENSION; ?>">Register</a></li>
				<li><a href="page/register<?php echo PAGE_EXTENSION; ?>"><span class="social_login fb_login"></span></a></li>
				<li><a href="page/register<?php echo PAGE_EXTENSION; ?>"><span class="social_login google_login"></span></a></a></li>
			  </ul>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			  <div class="hotline">
				<?php
				$result = $groups -> getById(HOTLINE);
				if($conn->numRows($result) > 0) {
				  $row = $conn -> fetchArray($result);
				  echo $row['contents'];
				}
				?>
			  </div>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4">
			  <ul class="login-panel requirement">
				<li><a href="#" class="link-btn">Post Property <span>FREE</span></a></li>
				<li><a href="#" class="link-btn">Post Requirement</a></li>
			  </ul>
			</div>
		  </div>
		</div>
	  </div>
	  <!-- top navigation end -->

	  <div class="banner">
		<div class="container">
		  <div class="row">
			<div class="col-md-3">
			  <div class="logo">
				<a href="<?php echo BASE_URL; ?>"><img src="images/logo.jpg" class="img-responsive" alt="Mero Property"></a>
			  </div>
			</div>
			<div class="col-md-9">
			  <div class="search">
				<form name="frmSearch" method="post" action="" id="form-search" class="form-horizontal">
				  <div class="input-group">
					<input type="text" name="q" class="form-control">
					<span class="input-group-btn">
					  <i class="fa fa-search"></i>
					  <input type="hidden" name="search" value="Search">
					</span>
				  </div>
				</form>
			  </div>
			</div>
		  </div>
		  
		  
		  <nav class="navbar navbar-default custom-nav">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>          
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			  <ul class="nav navbar-nav">
				<?php
				$result = $groups->getByTypeParentId("Header Links", 0);
				while ($row = $conn->fetchArray($result)) {
				  ?>
				  <li><a href="<?php echo $row['urlname'] . PAGE_EXTENSION; ?>"><?php echo $row['name']; ?></a></li>
				  <?php
				}
				?>
			  </ul>
			</div><!-- /.navbar-collapse -->
		  </nav>

		</div>
	  </div>		
	</header>
	<!-- header end -->

	<section class="property-display">
	  <div class="container">
		<div class="row">
		  <div class="col-md-9">
			<div class="feature-category-wrap">
			  <div class="row">
				<div class="col-md-8">
				  <div class="feature-property">
					<h3>Featured Properties</h3>
					<div class="owl-carousel owl-theme">
					  <?php
					  $result = $properties -> getByAttributes(array("featured"=>"yes"), 0, 4);
					  while($row = $conn -> fetchArray($result)) {
						?>
						<div class="item">
						  <div class="feature-view">
							<img src="<?php CMS_PROPERTIES_DIR . $row['filename']; ?>" class="img-responsive" alt="<?php echo $row['tagline']; ?>">
							<div class="feature-detail">
							  <h4><a href="<?php echo $row['urlname'] . PAGE_EXTENSION; ?>"><?php echo $row['tagline']; ?></a></h4>
							  <div class="feature-det">
								<p><span>District: </span> <?php echo $row['district']; ?></p>
								<p><span>Place: </span> <?php echo $row['place']; ?></p>
								<p><span>Cost: </span> <?php echo $row['price']; ?></p>
							  </div>	
							  <div class="feature-view-btn">
								<a href="<?php echo $row['urlname'] . PAGE_EXTENSION; ?>" class="btn btn-default">View Details</a>
							  </div>	
							</div>
						  </div>
						</div>
						<?php
					  }
					  ?>
					</div>
				  </div>
				  <!-- feature view div end here -->
				  <div class="clearfix"></div>

				</div>
				<div class="col-md-4">

				  <div class="feature-land">
					<h3>Hot Properties</h3>
					<div class="feature-land-wrap">
					  <ul>
						<?php
						$result = $properties -> getByAttributes(array("hot"=>"yes"), 0, 2);
						while($row = $conn -> fetchArray($result)) {
						  ?>
						  <li class="feature-list">
							<div class="ih-item square effect6 from_top_and_bottom">
							  <a href="<?php $row['urlname'] . PAGE_EXTENSION; ?>">
								<div class="img"><img src="<?php echo CMS_PROPERTIES_DIR . $row['filename']; ?>" alt="<?php echo $row['tagline']; ?>" class="img-responsive"></div>
								<div class="info">
								  <h4><?php echo $row['tagline']; ?></h4>
								  <div class="feature-det">
									<p><span>District: </span> <?php echo $row['district']; ?></p>
									<p><span>Place: </span> <?php echo $row['location']; ?></p>
									<p><span>Cost: </span> <?php echo $row['price']; ?></p>
								  </div>
								</div>
							  </a>
							</div>
						  </li>
						  <?php
						}
						?>
					  </ul>

					  <div class="view-all-featured">
						<a href="">VIEW MORE</a>
					  </div>

					</div>
				  </div>
				  <!-- feature land end -->
				</div>
			  </div>
			</div>
			<!-- feature div end -->
			<div class="clearfix"></div>

			<div class="news-and-events">
			  <div class="row">
				<div class="col-md-5 col-sm-5 news-head">
				  <h3>REAL ESTATE NEWS & UPDATES</h3>
				</div>
				<div class="col-md-7 col-sm-7 news-list">
				  <ul class="news-update">
					<li class="news-item">Civil Homes Dhapakhe Civil Homes Phase 4 Price Rs10,000,000/- 
					  upto Rs20,000,000/- <a href="#">[read more+]</a></li>
					<li class="news-item">Civil Homes Dhapakhe Civil Homes Phase 4 Price Rs10,000,000/- 
					  upto Rs20,000,000/- <a href="#">[read more+]</a></li>
					<li class="news-item">Civil Homes Dhapakhe Civil Homes Phase 4 Price Rs10,000,000/- 
					  upto Rs20,000,000/- <a href="#">[read more+]</a></li>
					<li class="news-item">Civil Homes Dhapakhe Civil Homes Phase 4 Price Rs10,000,000/- 
					  upto Rs20,000,000/- <a href="#">[read more+]</a></li>
					<li class="news-item">Civil Homes Dhapakhe Civil Homes Phase 4 Price Rs10,000,000/- 
					  upto Rs20,000,000/- <a href="#">[read more+]</a></li>
					<li class="news-item">Civil Homes Dhapakhe Civil Homes Phase 4 Price Rs10,000,000/- 
					  upto Rs20,000,000/- <a href="#">[read more+]</a></li>
				  </ul>
				</div>
			  </div>
			</div>
			<!-- news and feature div end -->



			<div class="rent-section">
			  <h2>Property For Sale</h2>
			  <div class="owl-carousel owl-theme">


				<div class="item">
				  <div class="avail-property">
					<img src="images/pro1.png" class="img-responsive" alt="Feature View">
					<h3><a href="">House at Swoyambhu</a></h3>
				  </div>
				</div>


				<div class="item">
				  <div class="avail-property">
					<img src="images/pro2.png" class="img-responsive" alt="Feature View">
					<h3><a href="">House at Swoyambhu</a></h3>
				  </div>
				</div>


				<div class="item">
				  <div class="avail-property">
					<img src="images/pro3.png" class="img-responsive" alt="Feature View">
					<h3><a href="">House at Swoyambhu</a></h3>
				  </div>
				</div>


				<div class="item">
				  <div class="avail-property">
					<img src="images/pro1.png" class="img-responsive" alt="Feature View">
					<h3><a href="">House at Swoyambhu</a></h3>
				  </div>
				</div>




			  </div>
			</div><!-- rent section end -->
			<div class="clearfix"></div>



			<div class="rent-section">
			  <h2>Property For Rent</h2>
			  <div class="owl-carousel owl-theme">


				<div class="item">
				  <div class="avail-property">
					<img src="images/pro1.png" class="img-responsive" alt="Feature View">
					<h3><a href="">House at Swoyambhu</a></h3>
				  </div>
				</div>


				<div class="item">
				  <div class="avail-property">
					<img src="images/pro2.png" class="img-responsive" alt="Feature View">
					<h3><a href="">House at Swoyambhu</a></h3>
				  </div>
				</div>


				<div class="item">
				  <div class="avail-property">
					<img src="images/pro3.png" class="img-responsive" alt="Feature View">
					<h3><a href="">House at Swoyambhu</a></h3>
				  </div>
				</div>


				<div class="item">
				  <div class="avail-property">
					<img src="images/pro1.png" class="img-responsive" alt="Feature View">
					<h3><a href="">House at Swoyambhu</a></h3>
				  </div>
				</div>




			  </div>
			</div><!-- rent section end -->
			<div class="clearfix"></div>



			<div class="rent-section">
			  <h2>Land For Sale</h2>
			  <div class="owl-carousel owl-theme">


				<div class="item">
				  <div class="avail-property">
					<img src="images/pro1.png" class="img-responsive" alt="Feature View">
					<h3><a href="">House at Swoyambhu</a></h3>
				  </div>
				</div>


				<div class="item">
				  <div class="avail-property">
					<img src="images/pro2.png" class="img-responsive" alt="Feature View">
					<h3><a href="">House at Swoyambhu</a></h3>
				  </div>
				</div>


				<div class="item">
				  <div class="avail-property">
					<img src="images/pro3.png" class="img-responsive" alt="Feature View">
					<h3><a href="">House at Swoyambhu</a></h3>
				  </div>
				</div>


				<div class="item">
				  <div class="avail-property">
					<img src="images/pro1.png" class="img-responsive" alt="Feature View">
					<h3><a href="">House at Swoyambhu</a></h3>
				  </div>
				</div>




			  </div>
			</div><!-- rent section end -->
			<div class="clearfix"></div>







		  </div>
		  <div class="col-md-3">

			<div class="inquiry-box">
			  <h3>Add Your Requirement</h3>
			  <form method="post">
				<div class="form-group">
				  <input type="text" name="name" class="form-control" placeholder="Name">
				</div>

				<div class="form-group">
				  <input type="text" name="email" class="form-control" placeholder="Email">
				</div>

				<div class="form-group">
				  <input type="text" name="phone" class="form-control" placeholder="Phone">
				</div>

				<div class="form-group">
				  <textarea name="requirement" class="form-control" placeholder="Requirement"></textarea>
				</div>

				<div class="form-group">
				  <input type="submit" name="inquiry-btn" class="inquiry-btn" value="Submit">
				</div>

			  </form>
			</div>
			<!-- inquiry box end -->
			<div class="clearfix"></div>

			<div class="facility-section loan">
			  <h4><a href="">Housing Loan</a></h4>
			  <a href=""><img src="images/investment-bank.png" class="img-responsive" alt="Bank Loan"></a>
			</div>
			<!-- facility section end -->

			<div class="facility-section designer">
			  <h4><a href="">Interior Designer</a></h4>
			  <a href=""><img src="images/design.png" class="img-responsive" alt="Interior"></a>
			</div>
			<!-- facility section end -->

			<div class="facility-section architect">
			  <h4><a href="">Architech</a></h4>
			  <a href=""><img src="images/architech.png" class="img-responsive" alt="Architech"></a>
			</div>
			<!-- facility section end -->


			<div class="widget-area">
			  <h4>Widgets</h4>
			  <ul>
				<li><a href=""><span><img src="images/calculator.png" alt="calculator"></span> Home Loan Calculator</a></li>
				<li><a href=""><span><img src="images/report.png" alt="report"></span> Research Report</a></li>
				<li><a href=""><span><img src="images/finicial.png" alt="Finicial Advisory"></span> Financial Advisory</a></li>
				<li><a href=""><span><img src="images/converter.png" alt="converter"></span> Converter</a></li>

			  </ul>
			</div>
			<!-- widget area end -->
			<div class="clearfix"></div>

			<div class="testimonials-section">
			  <h3>Testimonials</h3>
			  <div class="testimonial-wrap">
				<div class="testimonials-txt">
				  <p>I can always rely on NPM for geting affordable apartments for my International guest.A life saviour at times.Would recommend their service to all expat communities. ..</p>
				</div>
				<div class="testimonial-wri">
				  <div class="testimonial-img"><img src="images/img.png" class="img-responsive" alt="testimonial"></div>
				  <div class="testi-add">
					<p>Mr. Sunil Shrestha</p>
					<p>TWS Nepal</p>

				  </div>
				</div>
			  </div>
			</div>

		  </div>
		  <div class="clearfix"></div>
		</div>
	  </div>
	</section>
	<!-- property display section end -->


	<section class="container">
	  <div class="find-location">
		<h2>Find a Locations</h2>
		<div class="owl-carousel owl-theme">


		  <div class="item">
			<div class="location-wrap">
			  <h3>Kathmandu</h3>
			  <div class="location-wrap-inn">
				<div class="row">
				  <div class="col-md-02 col-sm-4 col-xs-6">
					<ul>
					  <li><a href="">Adheshwar(1)</a></li>
					  <li><a href="">Alapot(1)</a></li>
					  <li><a href="">Anamnagar(6)</a></li>
					  <li><a href="">Arubari(1)</a></li>
					  <li><a href="">Asan(1)</a></li>
					  <li><a href="">Asan(1)</a></li>

					</ul>
				  </div>

				  <div class="col-md-02 col-sm-4 col-xs-6">
					<ul>
					  <li><a href="">Adheshwar(1)</a></li>
					  <li><a href="">Alapot(1)</a></li>
					  <li><a href="">Anamnagar(6)</a></li>
					  <li><a href="">Arubari(1)</a></li>
					  <li><a href="">Asan(1)</a></li>
					  <li><a href="">Asan(1)</a></li>

					</ul>
				  </div>

				  <div class="col-md-02 col-sm-4 col-xs-6">
					<ul>
					  <li><a href="">Adheshwar(1)</a></li>
					  <li><a href="">Alapot(1)</a></li>
					  <li><a href="">Anamnagar(6)</a></li>
					  <li><a href="">Arubari(1)</a></li>
					  <li><a href="">Asan(1)</a></li>
					  <li><a href="">Asan(1)</a></li>

					</ul>
				  </div>              			

				  <div class="col-md-02 col-sm-4 col-xs-6">
					<ul>
					  <li><a href="">Adheshwar(1)</a></li>
					  <li><a href="">Alapot(1)</a></li>
					  <li><a href="">Anamnagar(6)</a></li>
					  <li><a href="">Arubari(1)</a></li>
					  <li><a href="">Asan(1)</a></li>
					  <li><a href="">Asan(1)</a></li>

					</ul>
				  </div>


				  <div class="col-md-02 col-sm-4 col-xs-6">
					<ul>
					  <li><a href="">Adheshwar(1)</a></li>
					  <li><a href="">Alapot(1)</a></li>
					  <li><a href="">Anamnagar(6)</a></li>
					  <li><a href="">Arubari(1)</a></li>
					  <li><a href="">Asan(1)</a></li>
					  <li><a href="">Asan(1)</a></li>

					</ul>
				  </div>
				  <div class="clearfix"></div>
				</div>
			  </div>
			</div>
		  </div>


		  <div class="item">
			<div class="location-wrap">
			  <h3>Kathmandu</h3>
			  <div class="location-wrap-inn">
				<div class="row">
				  <div class="col-md-02 col-sm-4 col-xs-6">
					<ul>
					  <li><a href="">Adheshwar(1)</a></li>
					  <li><a href="">Alapot(1)</a></li>
					  <li><a href="">Anamnagar(6)</a></li>
					  <li><a href="">Arubari(1)</a></li>
					  <li><a href="">Asan(1)</a></li>
					  <li><a href="">Asan(1)</a></li>

					</ul>
				  </div>

				  <div class="col-md-02 col-sm-4 col-xs-6">
					<ul>
					  <li><a href="">Adheshwar(1)</a></li>
					  <li><a href="">Alapot(1)</a></li>
					  <li><a href="">Anamnagar(6)</a></li>
					  <li><a href="">Arubari(1)</a></li>
					  <li><a href="">Asan(1)</a></li>
					  <li><a href="">Asan(1)</a></li>

					</ul>
				  </div>

				  <div class="col-md-02 col-sm-4 col-xs-6">
					<ul>
					  <li><a href="">Adheshwar(1)</a></li>
					  <li><a href="">Alapot(1)</a></li>
					  <li><a href="">Anamnagar(6)</a></li>
					  <li><a href="">Arubari(1)</a></li>
					  <li><a href="">Asan(1)</a></li>
					  <li><a href="">Asan(1)</a></li>

					</ul>
				  </div>              			

				  <div class="col-md-02 col-sm-4 col-xs-6">
					<ul>
					  <li><a href="">Adheshwar(1)</a></li>
					  <li><a href="">Alapot(1)</a></li>
					  <li><a href="">Anamnagar(6)</a></li>
					  <li><a href="">Arubari(1)</a></li>
					  <li><a href="">Asan(1)</a></li>
					  <li><a href="">Asan(1)</a></li>

					</ul>
				  </div>


				  <div class="col-md-02 col-sm-4 col-xs-6">
					<ul>
					  <li><a href="">Adheshwar(1)</a></li>
					  <li><a href="">Alapot(1)</a></li>
					  <li><a href="">Anamnagar(6)</a></li>
					  <li><a href="">Arubari(1)</a></li>
					  <li><a href="">Asan(1)</a></li>
					  <li><a href="">Asan(1)</a></li>

					</ul>
				  </div>
				  <div class="clearfix"></div>
				</div>
			  </div>
			</div>
		  </div>


		</div>

	  </div>
	</section>
	<!-- container section end -->

	<section class="extra-links">
	  <div class="container">
		<h2>Quick Links</h2>
		<div class="row">
		  <div class="col-md-3">
			<div class="extra-link-inn">
			  <h3>Developers: Product & Support</h3>
			  <ul>
				<li><a href="">Head Hunting</a></li>
				<li><a href="">Event Management</a></li>
				<li><a href="">Real Estate Websites</a></li>
				<li><a href="">Listing Exposure</a></li>
				<li><a href="">Real Estate Marketing</a></li>
			  </ul>
			</div>
		  </div>

		  <div class="col-md-3">
			<div class="extra-link-inn">
			  <h3>Developers: Product & Support</h3>
			  <ul>
				<li><a href="">Head Hunting</a></li>
				<li><a href="">Event Management</a></li>
				<li><a href="">Real Estate Websites</a></li>
				<li><a href="">Listing Exposure</a></li>
				<li><a href="">Real Estate Marketing</a></li>
			  </ul>
			</div>
		  </div>


		  <div class="col-md-3">
			<div class="extra-link-inn">
			  <h3>Developers: Product & Support</h3>
			  <ul>
				<li><a href="">Head Hunting</a></li>
				<li><a href="">Event Management</a></li>
				<li><a href="">Real Estate Websites</a></li>
				<li><a href="">Listing Exposure</a></li>
				<li><a href="">Real Estate Marketing</a></li>
			  </ul>
			</div>
		  </div>



		  <div class="col-md-3">
			<div class="extra-link-inn">
			  <h3>Developers: Product & Support</h3>
			  <ul>
				<li><a href="">Head Hunting</a></li>
				<li><a href="">Event Management</a></li>
				<li><a href="">Real Estate Websites</a></li>
				<li><a href="">Listing Exposure</a></li>
				<li><a href="">Real Estate Marketing</a></li>
			  </ul>
			</div>
		  </div>

		  <div class="col-md-3">
			<div class="extra-link-inn">
			  <h3>Developers: Product & Support</h3>
			  <ul>
				<li><a href="">Head Hunting</a></li>
				<li><a href="">Event Management</a></li>
				<li><a href="">Real Estate Websites</a></li>
				<li><a href="">Listing Exposure</a></li>
				<li><a href="">Real Estate Marketing</a></li>
			  </ul>
			</div>
		  </div>

		  <div class="col-md-3">
			<div class="extra-link-inn">
			  <h3>Developers: Product & Support</h3>
			  <ul>
				<li><a href="">Head Hunting</a></li>
				<li><a href="">Event Management</a></li>
				<li><a href="">Real Estate Websites</a></li>
				<li><a href="">Listing Exposure</a></li>
				<li><a href="">Real Estate Marketing</a></li>
			  </ul>
			</div>
		  </div>

		  <div class="col-md-4">
			<div class="extra-link-inn">
			  <h3>Subscribe Newsletter</h3>
			  <div class="search-sec">
				<form method="post">
				  <input type="text" name="search-txt" class="form-control">
				  <button type="submit" name="search-btn" class="search-btn"><img src="images/submit.png" alt="Search"></button>
				</form>
			  </div>
			</div>
		  </div>
		  <div class="clearfix"></div>
		</div>
	  </div>	
	</section>
	<!-- extra link end -->

	<footer id="footer">
	  <div class="container">
		<div class="social-media-links">
		  <ul class="list-inline">
			<li><a href=""><img src="images/facebook.png" alt="facebook"></a></li>
			<li><a href=""><img src="images/twitter.png" alt="facebook"></a></li>
			<li><a href=""><img src="images/linkedin.png" alt="facebook"></a></li>
			<li><a href=""><img src="images/google-plus.png" alt="facebook"></a></li>
			<li><a href=""><img src="images/youtube.png" alt="facebook"></a></li>
		  </ul>
		</div>
		<div class="clearfix"></div>

		<div class="footer-nav">
		  <ul class="list-inline">
			<li><a href="">Sitemap</a></li>
			<li><a href="">Privacy Policies</a></li>
			<li><a href="">Terms & Conditions</a></li>
			<li><a href="">Affiliates</a></li>
			<li><a href="">List Your Property</a></li>

		  </ul>
		</div>
		<!-- footer nav end -->
		<div class="clearfix"></div>

		<div class="copyright">
		  Copyright 2014 <strong>Nepal Property Market</strong> · All rights reserved. <br />
		  Powered by: <a href="http://www.weblinknepal.com" target="_blank"><img src="images/weblinknepa.png" alt="Weblink Nepal"></a>
		</div>

	  </div>
	  <div class="clearfix"></div>
	</footer>	


	<script src="js/jquery.min.js"></script>	
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.responsiveTabs.js"></script>
	<script src="js/owl.carousel.js"></script>
	<script src="js/jquery.bootstrap.newsbox.min.js"></script>
	<script>
      $(document).ready(function () {
        $('.feature-property > .owl-carousel').owlCarousel({
          loop: true,
          autoplay: true,
          margin: 0,
          responsiveClass: true,
          nav: false,
          items: 1
        })
      })
      $(document).ready(function () {
        $('.rent-section > .owl-carousel').owlCarousel({
          loop: true,
          autoplay: true,
          margin: 15,
          dots: false,
          responsiveClass: true,
          nav: true,
          items: 3,
          responsive: {
            0: {
              items: 1,
              nav: true
            },
            600: {
              items: 2,
              nav: false
            },
            1000: {
              items: 3,
              nav: true,
              loop: false
            }
          }
        })
      })

      $(document).ready(function () {
        $('.find-location > .owl-carousel').owlCarousel({
          loop: true,
          nav: true,
          navText: ['<img src="images/location-left.png" alt="left">', '<img src="images/location-right.png" alt="left">'],
          autoplay: false,
          margin: 0,
          responsiveClass: true,
          dots: false,
          items: 1
        })
      })

      $(".news-update").bootstrapNews({
        newsPerPage: 1,
        autoplay: true,
        pauseOnHover: true,
        navigation: false,
        direction: 'up',
        newsTickerInterval: 2500,
        onToDo: function () {
        }
      });

	</script>
  </body>
</html>