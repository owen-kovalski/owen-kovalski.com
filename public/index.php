<?php
    include_once 'header.php';
?>

<!--- Image Slider -->
<div id="slides" class="carousel slide" data-ride="carousel" data-aos="fade-up"
		data-aos-offset="200"
		data-aos-delay="50"
		data-aos-duration="1000">
	<ul class="carousel-indicators">
		<li data-target="#slides" data-slide-to="0" class="active"></li>
		<li data-target="#slides" data-slide-to="1"></li>
		<li data-target="#slides" data-slide-to="2"></li>
	</ul>
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img class="img-fluid" src="img/background2_1.jpg">
			<div class="carousel-caption">
				<h1 class="display-2">Website</h1>
				<h3>Complete Website Layout</h3>
				<button type="button" class="btn btn-outline-light btn-lg">VIEW
				DEMO</button>
				<button type="button" class="btn btn-primary btn-lg">Get Started</button>
			</div>
		</div>
		<div class="carousel-item">
			<img class="img-fluid" src="img/background2_1.jpg">
		</div>
		<div class="carousel-item">
			<img class="img-fluid" src="img/background2.jpg">
		</div>
	</div>
</div>
<br>
<!--- Jumbotron -->
<div class="container" data-aos="fade-up"
		data-aos-offset="200"
		data-aos-delay="50"
		data-aos-duration="1000">
	<div class="row jumbotron">
		<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-10">
			<p class="lead">Website development has to start somewhere. Start with a domain name!</p>
        <br>
        <br>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-2">
			<a href="https://domains.google/"><button type="button" class="btn btn-outline-secondary
			btn-lg">Get Your Domain Name</button></a>
		</div>
	</div>
</div>

<?php
    include_once 'footer.php';
?>