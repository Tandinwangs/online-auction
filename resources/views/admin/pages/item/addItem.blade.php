@include('admin.partials.navbar')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#statusSwitch').change(function () {
                if (!$(this).is(':checked')) {
                    // If checkbox is being unchecked, show confirmation dialog
                    var confirmed = confirm("Are you sure you want to close the item? This action cannot be undone.");
                    if (!confirmed) {
                        // Revert checkbox to checked state if user cancels
                        $(this).prop('checked', true);
                    }
                }
            });
        });
  </script>

<main id="main" class="main">

<div class="pagetitle">
  <h1>Add Item</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Items</li>
      <li class="breadcrumb-item active">Add Items</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<section class="section">
  <div class="row">
    <div class="col-lg-6">


    </div>

    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Add New Item</h5>

          <!-- No Labels Form -->
          <form class="row g-3" action="{{ isset($item) ? route('item.update', $item->id) : route('item.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @if(isset($item))
                @method('PATCH')
            @endif

            <div class="col-md-6">

            <input type="text" class="form-control" placeholder="User_id" name="user_id" value="{{Auth::user()->id}}" hidden>

              <input type="text" class="form-control" placeholder="Item Name" name="name" value="{{ $item->name ?? '' }}">
              @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-6">
                <select id="inputState" class="form-select" name="category_id">
                    <option value="">Category...</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ isset($item) && $item->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            
            <div class="col-md-6">
                <select id="inputState" class="form-select" name="auction_reference_id">
                    <option value="">Reserve Date...</option>
                    @foreach ($auctionRefDates as $auctionRefDate)
                        <option value="{{ $auctionRefDate->id }}" {{ isset($item) && $item->auction_reference_id == $auctionRefDate->id ? 'selected' : '' }}>
                          {{ \Carbon\Carbon::parse($auctionRefDate->auction_reference_date)->format('jS F, Y') }} 
                        </option>
                    @endforeach
                </select>
                @error('auction_reference_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-6">
              <input type="text" class="form-control" name="starting_bid" placeholder="Starting Bid" value="{{ $item->starting_bid ?? '' }}" >
              @error('starting_bid')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <!-- <div class="col-md-6">
                <input type="text" class="form-control" name="current_bid" placeholder="Current Bid" value="{{ $item->current_bid ?? '' }}">
                @error('current_bid')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div> -->
            <div class="col-md-6">
                <input type="text" class="form-control" name="reserve_price" placeholder="Reserved Price" value="{{ $item->reserve_price ?? '' }}">
                @error('reserve_price')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="images">Upload Images</label>
                <input type="file" class="form-control" name="images[]" multiple>
                @error('images')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Display previously uploaded images (if editing) -->
            @if(isset($item) && $item->images->count())
                <div class="form-group">
                    <label>Current Images</label>
                    <div class="row">
                        @foreach($item->images as $image)
                            <div class="col-3">
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="Item Image" class="img-thumbnail" width="100">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
       

            <div class="col-md-6">
              <div class="form-group">
                  <label>Status</label>
                  <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="statusSwitch" name="status" value="1" 
                            {{ old('status', isset($item) && $item->status == 1 ? 'checked' : '') }}>
                      <label class="form-check-label" for="statusSwitch">
                          {{ old('status', isset($item) && $item->status == 1 ? 'Open for Auction' : 'Closed') }}
                      </label>
                  </div>
                  @error('status')
                      <small class="text-danger">{{ $message }}</small>
                  @enderror
              </div>
          </div>

            <div class="col-md-6">
                <textarea placeholder="Desc" class="form-control" id="floatingTextarea" style="height: 100px;" name="description">{{ old('description', $item->description ?? '') }}</textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">
                    {{ isset($item) ? 'Update' : 'Submit' }}
                </button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>


          </form><!-- End No Labels Form -->

        </div>
      </div>

    </div>
  </div>
</section>

</main>

@include('admin.partials.footer')