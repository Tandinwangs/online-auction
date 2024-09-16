@include('admin.partials.navbar')

<main id="main" class="main">

<div class="pagetitle">
  <h1>Admins</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Tables</li>
      <li class="breadcrumb-item active">Admin-users</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      
      <div class="card">
 
        <div class="card-body"> 
            
          <h5 class="card-title">Admin-Users</h5>
          <div class="float-righ">     

          <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#basicModal">
               Add New User
            </button>
              <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Add User</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" method="POST" action="{{ route ('adminuser.store') }}">
                            @csrf
                            <div class="col-12">
                              <label for="name" class="form-label">Name</label>
                              <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="col-12">
                                <label for="floatingTextarea">email</label>
                                <input type="email" class="form-control" id="floatingTextarea" name="email">
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
                    <th><b>Name</b></th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($adminUsers as $user)
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
