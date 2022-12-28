<?php
	include_once 'includes/header.php';
?>
<body>
<?php
    include_once 'includes/nav.php';
?>
<section class="bg-dark text-light p-5 text-center text-sm-start">
	<div class="container" 
			data-aos="fade-up"
			data-aos-offset="200"
			data-aos-delay="50"
			data-aos-duration="1000">
		<div class="row jumbotron">
			<div class="d-sm-flex justify-content-between">
				<h1 class="display-1">COMING SOON!</h1>
        	<hr>
			</div>
		</div>
	</div>
</section>
<section>
	<div>
		<h1>Blog</h1>
		<div id="posts">
		<!-- Posts will be displayed here -->
		</div>
		<!-- Only show the form if the user is signed in and has the "admin" or "editor" tag -->
		<% if (user.isSignedIn && (user.tags.includes('admin') || user.tags.includes('editor'))) { %>
		<form id="post-form">
			<label for="title">Title:</label><br>
			<input type="text" id="title" name="title"><br>
			<label for="content">Content:</label><br>
			<textarea id="content" name="content"></textarea><br>
			<button type="submit">Post</button>
		</form>
		<% } %>
	</div>
</section>
</body>
<?php
    include_once 'includes/footer.php';
?>