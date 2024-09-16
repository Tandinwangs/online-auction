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
							<img src="{{ asset('assets/user/images/hero-banner2.jpg') }}">
						</div>
					</div>
				</div>
				
				<!--Text only with background image-->
				<div class="carousel-item" style="background: url('{{ asset('assets/user/images/hero-banner3.png') }}') center;">
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
							<!-- Display item status with CSS classes -->
							<p class="{{ $item->status == 1 ? 'status-open' : 'status-closed' }}">
								Status: {{ $item->status == 1 ? 'Open' : 'Closed' }}
							</p>
						</div>

						<a type="button"
							class="btn btn-primary btn-sm"
							href="{{ route('bid.show', $item->id) }}">
							{{ $item->status == 0 ? 'Unavailable' : 'Place Your Bid' }}
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
		
</html>