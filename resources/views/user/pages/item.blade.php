@include('user.header.header')

<section class="featured-block text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center">
                <div class="product-image mt-3">
                    <img class="img-fluid" src="{{ asset($item->image_path) }}" alt="{{ $item->name }}">
                </div>
            </div>
            <div class="col-md-6 mt-5 mt-md-2 text-center text-md-left">
                <h4 class="mb-3 mt-0">{{ $item->name }}</h4>
                <p class="lead mt-2 mb-3 primary-color">Nu. {{ number_format($item->current_bid) }}</p>
                <h5 class="mt-4">Description</h5>
                <p>{{ $item->description }}</p>

                @if ($hasPaid)
                    <!-- Bid Form -->
                    <form action="{{ route('bid.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <input type="text" class="form-control mb-4" name="amount" placeholder="Bid Amount" required>
                        @error('amount')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <button type="submit" class="btn btn-full-width btn-lg btn-outline-primary">Place Bid</button>
                    </form>
                @else
				<form action="{{ route('payment.store', ['item_id' => $item->id]) }}" method="POST" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
					<div class="form-group">
						<label for="screenshot">Upload Screenshot of Payment to Acc 2XXXXXXXX:</label>
						<input type="file" class="form-control" name="screenshot" id="screenshot" required>
						@error('screenshot')
							<small class="text-danger">{{ $message }}</small>
						@enderror
					</div>
					<button type="submit" class="btn btn-full-width btn-lg btn-primary">Submit Payment</button>
				</form>

                @endif
            </div>
        </div>
    </div>
</section>

<section class="products text-center">
			<div class="container">
				<div class="row">
					<!-- Related Products Section -->
					<div class="col-md-9">
						<h4 class="mb-4">Related Products</h4>
						<div class="row">
							<!-- Repeat the product cards as needed -->
							@foreach ($relatedItems as $ritem)
                                <div class="col-sm-6 col-md-3 col-product">
                                        <figure>
                                            <img class="rounded-corners img-fluid" src="{{ asset($ritem->image_path) }}" style="height: 100px; width:140px">
                                        </figure>
                                        <h5>{{ $ritem->name }}</h5>
                                        <p><span class="emphasis">Nu.{{ $ritem->current_bid }}</span></p>
                                        <div class="auction-timer">
                                            <p>Auction ends in:</p>
                                            <div class="countdown" data-end-time="{{ $ritem->auction_end }}"></div>
                                        </div>
                                        @php
                                            $auctionExpired = \Carbon\Carbon::now()->greaterThan($ritem->auction_end);
                                        @endphp
                                        <a type="button" 
                                        class="btn btn-primary btn-sm {{ $auctionExpired ? 'disabled' : '' }}" 
                                        href="{{ $auctionExpired ? '#' : route('bid.show', $ritem->id) }}" 
                                        {{ $auctionExpired ? 'aria-disabled="true"' : '' }}>
                                        Bid Now
                                        </a>
                                </div>
                            @endforeach
							<!-- Repeat for other products -->
						</div>
					</div>

                    <hr>
		
					<!-- My Bids Section -->
					<div class="col-md-3">
						<h4 class="mb-4">Bid History</h4>
						<div class="row">
							<!-- Repeat for each bid -->
							<div class="col-12 col-product">
								<figure>
									<img class="rounded-corners img-fluid" src="{{ asset($item->image_path) }}" width="240" height="240">
								</figure>
								<h4>{{ $item->name }}</h4>
                                <a id="toggleBidInfo" ><i class="fas fa-eye"></i></a>
                                <div id="bidInfo" style="display: none;">
                                    <div class="row mt-3">
                                        <!-- My Bid Section -->
                                        <div class="col-6 text-center" style="background-color: #e0f7fa; padding: 10px; border-radius: 5px;">
                                        <h6 class="mb-2"><i class="fas fa-user"></i> My Bid</h6>
                                            @if($myBid != null)
                                            <p class="emphasis">Nu.{{ number_format($myBid->amount)}}</p>
                                            @else
                                            <p class="emphasis">NA</p>
                                            @endif
                                        </div>
                                        <!-- Other Highest Bid Section -->
                                        <div class="col-6 text-center" style="background-color: #ffebee; padding: 10px; border-radius: 5px;">
                                            <h6 class="mb-2"><i class="fas fa-trophy"></i>Highest Bid</h6>
                                            @if($highestBid != null)
                                            <p class="emphasis">Nu.{{ number_format($highestBid->amount) }}</p>
                                            @else
                                            <p class="emphasis">NA</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
							</div>
							<!-- Repeat for other bids -->
						</div>
					</div>
				</div>
			</div>
</section>
		

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('toggleBidInfo');
        const bidInfo = document.getElementById('bidInfo');

        toggleBtn.addEventListener('click', function(event) {
            event.preventDefault();
            if(bidInfo.style.display === 'none' || bidInfo.style.display === ''){
                bidInfo.style.display = 'block';
            }else{
                bidInfo.style.display = 'none';
            }
        })
    })
</script>


<div class="divider"></div>
@include('user.footer.footer')
