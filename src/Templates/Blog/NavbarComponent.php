<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark" style="padding: 0; max-width: 100%;">
	<div class="container" style="background: #181b1e; max-width: 100%;">
		<a href="/" class="navbar-brand">Blog</a>
		<button type="button" class="navbar-toggler" data-bs-target="#navbarNav"
			data-bs-toggle="collapse" aria-controls="navbarNav" aria-expanded="false"
			aria-lable="Toggle Navbar">
			<span class="navbar-toggler-icon"></span>
		</button>
		
		<div class="collapse navbar-collapse" id="navbarNav">
			<div class="mx-auto"></div>
			<ul class="navbar-nav">
				<form id="searchform" class="d-flex mx-auto" >
					<input id="searchbox" class="form-control me-2 bg-dark text-white" type="search" placeholder="Search" aria-label="Search">
					<!--button class="btn btn-outline-success" type="submit">Search</button-->
				</form>
				<!--li class="nav-item">
					<a href="/" class="nav-link text-white">Home</a>
				</li-->
				<?php if (isset($_SESSION['userid'])): ?>
					<li class='nav-item'>
					<a href='@<?php echo $_SESSION['accname']; ?>' class='nav-link text-white'>Personal Blog</a>
					</li>
					<li class='nav-item'>
					<a href='/upload' class='nav-link text-white'>Upload Blog</a>
					</li>
					<li class='nav-item dropdown'>
						<a class='nav-link dropdown-toggle' id='navbarDropdown'
							role='button' data-bs-toggle='dropdown' aria-expand='false'>
							User
						</a>
						<ul class='dropdown-menu bg-dark' aria-labelledby='navbarDropdown'>
							<li><a class='dropdown-item text-white' href='/pref'>Preferences</a></li>
							<li><a class='dropdown-item text-white' href='/logout'>Logout</a></li>
						</ul>
					</li>
				<?php else: ?>
					<li class="nav-item">
						<a href="/login" class="nav-link text-white">Login</a>
					</li>
					<li class="navbar-nav">
						<a href="/register" class="nav-link text-white">Register</a>
					</li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</nav>

<!-- AJAX JQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>

$(function() {
	$('#searchform').submit(function(e) {
		console.log('called');
		$.ajax({
			method: "POST",
			url: "/search.php",
			data: { 'term': $('#searchbox').val() },
			dataType: 'json',
			async: 'false'
		})
			.done(function(response) {
				console.log(response);
			});
		e.preventDefault();
	});
});

</script>

<!-- Banner Image
<div class="banner-image w-100 vh-100 d-flex justify-content-center
	align-items-center">
	<div class="content text-center">
		<h1 class="text-white">BLOG</h1>
	</div>
</div>-->

<!-- Main Content Area -->

