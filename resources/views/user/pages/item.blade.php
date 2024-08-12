@include('user.header.header')

<section class="featured-block text-center">
			<div class="container">
				<div class="row">
					<div class="col-md-6 text-center">
						<div class="product-image mt-3">
							<img class="img-fluid" src="{{ asset ($item->image_path) }}">
						</div>
					</div>
					<div class="col-md-6 mt-5 mt-md-2 text-center text-md-left">
						<h2 class="mb-3 mt-0">{{$item->name}}</h2>
						<p class="lead mt-2 mb-3 primary-color">Nu.{{$item->starting_bid}}</p>
						<h5 class="mt-4">Description</h5>
						<p>{{$item->description}}</p>
                        <form action="{{ route ('bid.store') }}" method="POST">
                            @csrf
                            <input type="text" class="form-control mb-4" name="user_id" placeholder="user_id" value="{{Auth::user()->id}}" hidden>
                            <input type="text" class="form-control mb-4" name="item_id" placeholder="item_id" value="{{ $item->id }}" hidden>
                            <input type="text" class="form-control mb-4" name="amount" placeholder="Bid Amount" required>
							@error('amount')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <button type="submit" class="btn btn-full-width btn-lg btn-outline-primary">Place Bid</button></div>
                        </form>
						
				</div>
			</div>
			</div>
		</section>
		
		<div class="divider"></div>
		
		<section class="products text-center">
			<div class="container">
				<h3 class="mb-4">Related Products</h3>
				<div class="row">
					<div class="col-sm-6 col-md-3 col-product">
						<figure>
							<img class="rounded-corners img-fluid" src="images/machine.png"	width="240" height="240">
							<figcaption>
								<div class="thumb-overlay"><a href="#" title="More Info">
									<i class="fas fa-search-plus"></i>
								</a></div>
							</figcaption>
						</figure>
						<h4><a href="#">{{ $item->name }}</a></h4>
						<p><span class="emphasis">$19.00</span></p>
					</div>
					<div class="col-sm-6 col-md-3 col-product">
						<figure>
							<img class="rounded-corners img-fluid" src="images/machine.png"	width="240" height="240">
							<figcaption>
								<div class="thumb-overlay"><a href="#" title="More Info">
									<i class="fas fa-search-plus"></i>
								</a></div>
							</figcaption>
						</figure>
						<h4><a href="#">Product Name</a></h4>
						<p><span class="emphasis">$19.00</span></p>
					</div>
					<div class="col-sm-6 col-md-3 col-product">
						<figure>
							<img class="rounded-corners img-fluid" src="images/machine.png"	width="240" height="240">
							<figcaption>
								<div class="thumb-overlay"><a href="#" title="More Info">
									<i class="fas fa-search-plus"></i>
								</a></div>
							</figcaption>
						</figure>
						<h4><a href="#">Product Name</a></h4>
						<p><span class="emphasis">$19.00</span></p>
					</div>
					<div class="col-sm-6 col-md-3 col-product">
						<figure>
							<img class="rounded-corners img-fluid" src="images/machine.png"	width="240" height="240">
							<figcaption>
								<div class="thumb-overlay"><a href="#" title="More Info">
									<i class="fas fa-search-plus"></i>
								</a></div>
							</figcaption>
						</figure>
						<h4><a href="#">Product Name</a></h4>
						<p><span class="emphasis">$19.00</span></p>
					</div>
				</div>
			</div>
		</section>
		
		<div class="divider"></div>

@include('user.footer.footer')