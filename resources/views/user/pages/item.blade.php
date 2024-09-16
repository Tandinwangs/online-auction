@include('user.header.header')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            function refreshContent() {
                // Use AJAX to fetch and replace the content of the #bidInfo div
                $('#bidInfo').load(window.location.href + ' #bidInfo > *');
            }

            // Set interval for refreshing content every 30 seconds
            setInterval(refreshContent, 20000); // 30000 milliseconds = 30 seconds

            // Initial fetch to populate content on page load
            refreshContent();
        });
    </script>

<section class="featured-block text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center">
                <div class="product-image mt-3">
                    <img class="img-fluid" src="{{ asset($item->image_path) }}" alt="{{ $item->name }}">
                </div>
            </div>
            <div class="col-md-6 mt-5 mt-md-2 text-center text-md-left">

                @if ($item->status === 0 && $user->is($bidUser))
                <div class="congratulations-container mt-2 p-4 border border-info rounded">
                            <div class="icon mb-3">
                                <i class="fas fa-trophy fa-2x text-info"></i>
                            </div>

                            @if (!$finalPayment || $finalPayment->status === "rejected")
                            <h4 class="mb-3 text-info">Congratulations!</h4>
                            <p class="mb-3">You have won the bid for this item. Please make the payment of Nu {{ number_format($payable) }} and upload a screenshot.</p>
                                <form action="{{ route('finalpayment.pay', ['item_id' => $item->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="paymentScreenshot" class="form-label">Upload Payment Screenshot</label>
                                    <input type="file" class="form-control-file" id="paymentScreenshot" name="screenshot" required>
                                    @error('screenshot')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-info btn-md">Upload Screenshot</button>
                            </form>
                            @else
                            <h4 class="mb-3 text-info">Congratulations!</h4>
                            <p class="mb-3">You have successfully submitted the payment details for the item.</p>
                            <p>Payment Status: <span class="text-info">{{ $finalPayment->status }}</span></p>
                            @endif
                        </div>
                @elseif ($item->status === 0 && !$user->is($bidUser))
                <div class="sorry-container mt-2 p-4 border border-info rounded">
                            <div class="icon mb-3">
                                <i class="fas fa-times fa-2x text-danger"></i>
                            </div>
                            <h4 class="mb-3 text-danger">Sorry you lost the bid!</h4>
                            <p class="mb-3">Please keep an eye out for the future auctions.</p>
                        </div>
                @else
                <h4 class="mb-3 mt-0" style="font-weight: bold">{{ $item->name }}</h4>
                <p class=" mt-2 mb-3 primary-color">Current Bid: Nu. {{ number_format($item->current_bid) }}</p>
                <h5 class="mt-4">Description</h5>
                <p>{{ $item->description }}</p>

                    @if ($hasPaid)
                        <!-- Bid Form -->
                        <form  id="bid-form" action="{{ route('bid.store') }}" method="POST">
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
                                            <!-- Display item status with CSS classes -->
                                            <p class="{{ $ritem->status == 1 ? 'status-open' : 'status-closed' }}">
                                                Status: {{ $ritem->status == 1 ? 'Open' : 'Closed' }}
                                            </p>
                                        </div>

                                        <a type="button"
                                            class="btn btn-primary btn-sm"
                                            href="{{ route('bid.show', $ritem->id) }}">
                                            {{ $ritem->status == 0 ? 'Unavailable' : 'Place Your Bid' }}
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
                                <div id="bidInfo">
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

                                    <div class="row mt-3">
                                        <!-- Active Bidders Section -->
                                        <div class="col-12 text-center" style="background-color: #f0f4c3; padding: 10px; border-radius: 5px;">
                                            <h6 class="mb-2"><i class="fas fa-users"></i> Active Bidders</h6>
                                            <p class="emphasis">{{ $activeBidder }}</p>
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

<script>
    Echo.channel('bids.{{ $item->id }}')
        .listen('.BidPlaced', (e) => {
            const highestBidElement = document.querySelector('#bidInfo .emphasis:nth-child(2)');
            highestBidElement.textContent = `Nu. ${new Intl.NumberFormat().format(e.highestBid)}`;
        });
</script>

<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const bidForm = document.getElementById('bid-form');
        const myBidElement = document.querySelector('#bidInfo .emphasis:nth-child(1)');
        const highestBidElement = document.querySelector('#bidInfo .emphasis:nth-child(2)');

        bidForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            const formData = new FormData(this);

            fetch(bidForm.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error); // Handle validation or other errors
                } else {
                    // Update the "My Bid" and "Highest Bid" sections
                    myBidElement.textContent = data.myBid ? `Nu. ${new Intl.NumberFormat().format(data.myBid)}` : 'NA';
                    highestBidElement.textContent = data.highestBid ? `Nu. ${new Intl.NumberFormat().format(data.highestBid)}` : 'NA';

                    // Optionally, display the bid info if it's hidden
                    const bidInfo = document.getElementById('bidInfo');
                    if (bidInfo.style.display === 'none') {
                        bidInfo.style.display = 'block';
                    }
                    alert(data.success); // Display success message
                }
            })
            .catch(error => console.log('Error:', error));
        });
    });
</script> -->


<div class="divider"></div>
@include('user.footer.footer')
