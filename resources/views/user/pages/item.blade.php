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
                <h2 class="mb-3 mt-0">{{ $item->name }}</h2>
                <p class="lead mt-2 mb-3 primary-color">Nu. {{ $item->current_bid }}</p>
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
						<label for="screenshot">Upload Screenshot of Payment:</label>
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
            <h3 class="mb-4">Related Products</h3>
            <div class="row">
                @foreach ($relatedItems as $item)
                <div class="col-sm-6 col-md-3 col-product">
                    <figure>
                        <img class="rounded-corners img-fluid" src="{{ asset ($item->image_path) }}"	width="240" height="240">
                        <figcaption>
                            <div class="thumb-overlay"><a href="#" title="More Info">
                                <i class="fas fa-search-plus"></i>
                            </a></div>
                        </figcaption>
                    </figure>
                    <h4><a href="#">{{$item->name}}</a></h4>
                    <p><span class="emphasis">Nu. {{$item->current_bid}}</span></p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

<div class="divider"></div>
@include('user.footer.footer')
