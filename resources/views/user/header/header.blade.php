<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>BNB Auction</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<link href="{{ asset('assets/admin/img/icon.png') }}" rel="icon">
		<link rel="stylesheet" href="{{ asset('assets/user/bootstrap/css/bootstrap.css') }}">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		
		<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<link rel="stylesheet" href="{{ asset('assets/user/css/style.css') }}">
	</head>
	<body>
	
		<section class="header text-center">
			<nav class="navbar navbar-expand-lg navbar-light navbar-custom">
				<div class="container"><a class="navbar-brand" href="{{ route ('userhome') }}"><img src="{{ asset('assets/user/images/Logo_Primary.png') }}" class="logo" alt=""> Auction</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-1" aria-controls="navbar-1" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
					<div class="collapse navbar-collapse pull-xs-right justify-content-end" id="navbar-1">
						<ul class="navbar-nav mt-2 mt-md-0">
							<li class="nav-item active"><a class="nav-link" href="{{ route ('userhome') }}">Home <span class="sr-only">(current)</span></a></li>
							<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">RefDate </a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
									@foreach($recentReferences as $reference)
									<a class="dropdown-item" href="{{ route('items.index', ['auction_reference_date' => $reference->auction_reference_date]) }}">{{ $reference->auction_reference_date }}</a>
									@endforeach
									
							</li>
                            @if(Auth::user())
							<!-- @if(Auth::user()->hasRole('admin'))
								<p>Welcome, Admin!</p>
							@else
								<p>Welcome, User!</p>
							@endif -->
                            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i></a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
									<a href="{{ route('logout') }}" class="dropdown-item" style="margin: 0;">Logout</a></div>
							</li>
                            @else
                            <li class="nav-item"><a class="nav-link"   href="{{ route('login') }}">Sign In</a></li>
							<li class="nav-item"><a class="nav-link"   href="{{ route('register') }}">Sign Up</a></li>
                            @endif
						</ul>
					</div>
				</div>
			</nav>
		</section>