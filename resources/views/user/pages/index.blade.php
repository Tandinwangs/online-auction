@include('user.header.header')
		
		<div id="carousel" class="carousel slide" data-ride="carousel">
		
			<script>
				$('.carousel').carousel({
					interval: 200
				})
			</script>
			
			<!-- Carousel Indicators -->
			<ul class="carousel-indicators">
				<li data-target="#carousel" data-slide-to="0" class="active"></li>
				<li data-target="#carousel" data-slide-to="1"></li>
				<li data-target="#carousel" data-slide-to="2"></li>
			</ul>
		
			<!-- Carousel -->
			<div class="carousel-inner">
			
				<!--Text only with background image-->
				<div class="carousel-item active" style="background: url('{{ asset('assets/user/images/hero-banner1.png') }}') center;">
					<div class="container slide-textonly">
						<div>
							<!-- <h1>BNB Auction</h1>
							<p class="lead">Browse our Auction Items</p> -->
							<!-- <a href="#" class="btn btn-outline-secondary">View Collection</a> -->
						</div>
					</div>
				</div>
				
				<!--Text with image-->
				<div class="carousel-item">
					<div class="container slide-withimage">
						<div class="description">
							<h1>BNB Auction</h1>
							<p class="lead">Browse our Auction items</p>
					 		<!-- <a href="#" class="btn btn-outline-secondary">View Collection</a> -->
					 	</div>
						<div class="slide-image">
							<img src="{{ asset('assets/user/images/hero-banner2.jpg') }}" style="width: 80%;">
						</div>
					</div>
				</div>
				
				<!--Text only with background image-->
				<div class="carousel-item" style="background: url(images/bnb2.jpg) center;">
					<div class="container slide-textonly">
						<div>
							<h1>BNB Auction</h1>
							<p class="lead">Browse our Auction products</p>
							<!-- <a href="#" class="btn btn-outline-secondary">View Collection</a> -->
						</div>
					</div>
				</div>
			</div>
		</div>

		
		<section class="products text-center">
			<div class="container">
				<h3 class="mb-4">Auction Items</h3>
				<div class="row">
				@foreach ($items as $item)	
					<div class="col-sm-6 col-md-3 col-product">
						<figure>
							<img class="rounded-corners img-fluid" src="{{ asset($item->image_path) }}" style="width: 240px; height: 180px">
							<!-- <figcaption>
								<div class="thumb-overlay">
									<a href="{{ route ('bid.show', $item->id) }}" title="More Info">
										<i class="fas fa-search-plus"></i>
									</a>
								</div>
							</figcaption> -->
						</figure>
						<h4>{{ $item->name }}</h4>
						<p><span class="emphasis">Nu.{{ number_format($item->current_bid) }}</span></p>
						<div class="auction-timer">
							<p>Auction ends in:</p>
							<div class="countdown" data-end-time="{{ $item->auction_end }}"></div>
						</div>
						@php
							$auctionExpired = \Carbon\Carbon::now()->greaterThan($item->auction_end);
						@endphp
						<a type="button" 
						class="btn btn-primary btn-sm {{ $auctionExpired ? 'disabled' : '' }}" 
						href="{{ $auctionExpired ? '#' : route('bid.show', $item->id) }}" 
						{{ $auctionExpired ? 'aria-disabled="true"' : '' }}>
						Bid Now
						</a>
					</div>
				@endforeach
				</div>
			</div>
		</section>
		
		
		<div class="divider"></div>
		
		<!-- <section class="cta text-center">
			<div class="container">
				<h3 class="mt-0 mb-4">Sign up now to save 10% on your first order</h3>
				<form class="subscribe">
					<div class="form-group row pt-3">
						<div class="col-sm-8 mb-3">
							<input type="text" class="form-control" id="inputName" placeholder="Your Name">
						</div>
						<div class="col-sm-4">
							<button type="submit" class="btn btn-lg btn-outline-primary">Sign me up</button>
						</div>
					</div>
				</form>
			</div>
		</section> -->
		
@include('user.footer.footer')

	</body>

	<script>
		document.addEventListener('DOMContentLoaded', function () {
			var countdownElements = document.querySelectorAll('.countdown');
		
			countdownElements.forEach(function (countdownElement) {
				// Get the end time from the data attribute
				var countDownDate = new Date(countdownElement.getAttribute('data-end-time')).getTime();
		
				// Update the count down every 1 second
				var x = setInterval(function () {
					// Get today's date and time
					var now = new Date().getTime();
		
					// Find the distance between now and the count down date
					var distance = countDownDate - now;
		
					// Time calculations for days, hours, minutes and seconds
					var days = Math.floor(distance / (1000 * 60 * 60 * 24));
					var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
					var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
					var seconds = Math.floor((distance % (1000 * 60)) / 1000);
		
					// Display the result in the countdown element
					countdownElement.innerHTML = days + "d " + hours + "h " +
						minutes + "m " + seconds + "s ";
		
					// If the count down is over, write some text
					if (distance < 0) {
						clearInterval(x);
						countdownElement.innerHTML = "Auction Ended";
					}
				}, 1000);
			});
		});
	</script>
		
		
</html>