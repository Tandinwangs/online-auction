@include('admin.partials.navbar')

<main id="main" class="main">

<div class="pagetitle">
  <h1>Items</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Tables</li>
      <li class="breadcrumb-item active">item</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      
      <div class="card">
 
        <div class="card-body"> 
            
          <h5 class="card-title">Items</h5>
          <div class="float-righ">     
            <a type="button" class="btn btn-primary btn-sm" href="{{ route ('item.add') }}">
               Add New Item
            </a>

        </div>
     

          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
                <tr>
                    <th>
                      <b>N</b>ame
                    </th>
                    <th>Category</th>
                    <th>Start</th>
                    <th>Auction Completion</th>
                    <th>view</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                  <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td>{{ $item->auction_start }}</td>
                    <td>{{ $item->auction_end }}</td>   
                    <td>
                        <a type="button" data-bs-toggle="modal" data-bs-target="#viewItem{{ $item->id }}">
                        <i class="bi bi-eye"></i>
                        </a>
                        <div class="modal fade" id="viewItem{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title">Item View</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                            <div class="modal-body">
                                            <form class="row g-3">
                                                <div class="col-6">
                                                    <label for="name" class="form-label">Item Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}">
                                                </div>
                                                <div class="col-6">
                                                    <label for="name" class="form-label">Starting Bid</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ $item->starting_bid }}">
                                                </div>
                                                <div class="col-6">
                                                    <label for="name" class="form-label">Current Bid</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ $item->current_bid }}">
                                                </div>
                                                <div class="col-6">
                                                    <label for="name" class="form-label">Reserve Price</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ $item->reserve_price }}">
                                                </div>
                                                <div class="col-6">
                                           <img class="item-img" src="{{asset ($item->image_path) }}" alt="{{ $item->name }}">
                                                </div>
                                                <div class="col-12">
                                                    <label for="floatingTextarea">Description</label>
                                                    <textarea class="form-control" id="floatingTextarea" style="height: 100px;" name="description">{{ $item->description }}</textarea>
                                                </div>
                                                <div class="text-center">
                                                <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>                 
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </td>
                    <td>
                        <a type="button" class="btn btn-primary btn-sm" href="{{route ('item.edit', $item->id)}}">
                            Edit
                        </a>
                        <a type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteItem{{ $item->id }}">
                            Delete
                        </a>
                        <div class="modal fade" id="deleteItem{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title">Delete Confirmation</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                            <div class="modal-body">
                                            <form class="row g-3" action="{{ route ('item.delete', $item->id) }}" method="POST">
                                                @csrf
                                                <div class="col-12">
                                                    <label for="name" class="form-label">Are you sure you want to Delete this Item?</label>
                                                </div>
                                                <div class="text-center">
                                                <button type="submit" class="btn btn-primary" >Yes Delete</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>                 
                                        </div>
                                    </div>
                                </div>
                        </div>
        
                  </td>

                  </tr>
                  @endforeach
              
            </tbody>
          </table>
          <!-- End Table with stripped rows -->

        </div>
      </div>

    </div>
  </div>
</section>

</main>

@include('admin.partials.footer')