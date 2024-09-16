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
            <a type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#basicModal">
               Add reference Date
            </a>
          </div>

          <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Add Reference Date</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" method="POST" action="{{ route ('auctionReference.store') }}">
                            @csrf
                            <div class="col-12">
                              <label for="auction_reference_date" class="form-label">Date</label>
                              <input type="date" class="form-control" id="auction_reference_date" name="auction_reference_date">
                            </div>
                            <div class="text-center">
                              <button type="submit" class="btn btn-primary">Submit</button>
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                          </form>
            
                    </div>
                  
                  </div>
                </div>
              </div>


          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
                <tr>
                    <th>
                      <b>Date
                    </th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($auctionReferences as $refdate)
                  <tr>
                    <td>{{ $refdate->auction_reference_date }}</td>
                    <td>
                        <a type="button" data-bs-toggle="modal" data-bs-target="#editrefdate{{ $refdate->id }}">
                        <i class="bi bi-pen btn btn-primary btn-sm"></i>
                        </a>
                        <div class="modal fade" id="editrefdate{{ $refdate->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title">Edit refDate</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                            <div class="modal-body">
                                            <form class="row g-3" method="POST" action="{{ route('refdate.update', $refdate->id) }}" >
                                                @csrf
                                                @method('PATCH')
                                                <div class="col-6">
                                                    <label class="form-label">Date</label>
                                                    <input type="date" class="form-control" name="auction_reference_date" value="{{ $refdate->auction_reference_date }}">
                                                </div>
                                                <div class="text-center">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>                 
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <a type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletedate{{ $refdate->id }}">
                        <i class="bi bi-trash"></i>
                        </a>
                        <div class="modal fade" id="deletedate{{ $refdate->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title">Delete Confirmation</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                            <div class="modal-body">
                                            <form class="row g-3" action="{{ route('refdate.delete', $refdate->id) }}" method="POST">
                                                @csrf
                                              
                                                <div class="col-12">
                                                    <label for="name" class="form-label">Are you sure you want to Delete this Date?</label>
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