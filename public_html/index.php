<?php
    include_once '/includes/header.php';
	include_once '/includes/css/style.css';
?>

<body>
	<!-- Seperate Popper and Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
	    <div class="container-fluid">
		    <a class="navbar-brand" href="index.php">
				<img src="img/logo1.png" alt="" width="150" height="50">
			</a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			    <div class="navbar-nav">
				    <a class="nav-link" href="index.php">Home</a>
				    <a class="nav-link" href="blog.php">Blog</a>
				    <a class="nav-link" href="about.php">About</a>
				    <a class="nav-link" href="projects.php">Projects</a>
				    <a class="nav-link" href="team.php">Team</a>
				    <a class="nav-link" href="#">Login/Register</a>
			    </div>
		    </div>
	    </div>
    </nav>

<!-- Introduction -->
<br>
<br>
<section class="bg-dark text-light p-5 text-center text-sm-start">
	<div class="container" 
	    data-aos="fade-up"
		data-aos-offset="200"
		data-aos-delay="50"
		data-aos-duration="1000">
		<div class="d-sm-flex justify-content-between">
			<div>
				<h1>Follow me into the world of <span class="text-warning"> Information Technology </span></h1> 
				<p class="lead my-4"> 
					Learning IT can be fun. Follow to see interesting projects you can do yourself! 
				</p>
				<div>
					<a class="btn btn-outline-secondary btn-sm" href="https://domains.google/" style="text-color: white;">Get your Domain Name</a>
				</div>														   
			</div>
			<div>
				<img class="img-fluid w-50 d-none d-sm-block float-end" src="img/background2.jpg" alt="" />
			</div>
		</div>
	</div>
</section>

<br>
<br>
<br>
<br>
<br>
<br>
<!--- Jumbotron -->
<section class="bg-dark text-light p-5 text-center text-sm-start m-5">
	<div class="container" 
			data-aos="fade-up"
			data-aos-offset="200"
			data-aos-delay="50"
			data-aos-duration="1000">
		<div class="row jumbotron">
			<div class="d-sm-flex justify-content-between">
				<h1 class="display-1">BLOG COMING SOON!</h1>
        	<hr>
			</div>
		</div>
	</div>
</section>
<?php
    include_once '/includes/footer.php';
?>
