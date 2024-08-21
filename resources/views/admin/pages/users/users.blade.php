@include('admin.partials.navbar')

<main id="main" class="main">

<div class="pagetitle">
  <h1>Items</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Tables</li>
      <li class="breadcrumb-item active">Users</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      
      <div class="card">
 
        <div class="card-body"> 
            
          <h5 class="card-title">Users</h5>
          <div class="float-righ">     

          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
                <tr>
                    <th><b>Name</b></th>
                    <th>Email</th>
                    <th>cid</th>
                    <th>PhoneNo</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                  <tr>
                    @if($user->name)
                      <td>{{ $user->name }}</td>
                    @else
                      <td></td>
                    @endif
                    
                    @if($user->email)
                      <td>{{ $user->email }}</td>
                    @else
                      <td></td>
                    @endif

                    @if($user->cid)
                      <td>{{ $user->cid }}</td>
                    @else
                      <td></td>
                    @endif

                    @if($user->phone_number)
                      <td>{{ $user->phone_number }}</td>
                    @else
                      <td></td>
                    @endif   

                    <td>
                        <a type="button" data-bs-toggle="modal" data-bs-target="#viewUser{{ $user->id }}">
                        <i class="bi bi-eye"></i>
                        </a>
                        <div class="modal fade" id="viewUser{{ $user->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title">User View</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                            <div class="modal-body">
                                            <form class="row g-3">
                                                @if($user->name)
                                                <div class="col-6">
                                                    <label for="name" class="form-label">User Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                                                </div>
                                                @endif

                                                @if($user->email)
                                                <div class="col-6">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                                </div>
                                                @endif

                                                @if($user->cid)
                                                <div class="col-6">
                                                    <label for="cid" class="form-label">CID</label>
                                                    <input type="text" class="form-control" id="cid" name="cid" value="{{ $user->cid }}">
                                                </div>
                                                @endif

                                                @if($user->phone_number)
                                                <div class="col-6">
                                                    <label for="phone_number" class="form-label">Phone Number</label>
                                                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $user->phone_number }}">
                                                </div>
                                                @endif

                                                @if($user->dzongkhag)
                                                <div class="col-6">
                                                    <label for="dzongkhag" class="form-label">Dzongkhag</label>
                                                    <input type="text" class="form-control" id="dzongkhag" name="dzongkhag" value="{{ $user->dzongkhag->dzongname }}">
                                                </div>
                                                @endif

                                                @if($user->gewog)
                                                <div class="col-6">
                                                    <label for="gewog" class="form-label">Gewog</label>
                                                    <input type="text" class="form-control" id="gewog" name="gewog" value="{{ $user->gewog->gewogname }}">
                                                </div>
                                                @endif

                                                @if($user->village)
                                                <div class="col-6">
                                                    <label for="village" class="form-label">Village</label>
                                                    <input type="text" class="form-control" id="village" name="village" value="{{ $user->village->villname }}">
                                                </div>
                                                @endif

                                                <div class="text-center">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>                 
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </td>
                    <td>
                        <a type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteUser{{ $user->id }}">
                        <i class="bi bi-trash"></i>
                        </a>
                        <div class="modal fade" id="deleteUser{{ $user->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title">Delete Confirmation</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                            <div class="modal-body">
                                            <form class="row g-3" action="{{ route ('user.delete', $user->id) }}" method="POST">
                                                @csrf
                                                <div class="col-12">
                                                    <label for="name" class="form-label">Are you sure you want to delete this user?</label>
                                                </div>
                                                <div class="text-center">
                                                <button type="submit" class="btn btn-primary">Yes, Delete</button>
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
