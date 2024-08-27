@include('admin.partials.navbar')

<main id="main" class="main">

<div class="pagetitle">
  <h1>Categories</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Tables</li>
      <li class="breadcrumb-item active">category</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      
      <div class="card">
 
        <div class="card-body"> 
            
          <h5 class="card-title">Categories</h5>
          <div class="float-righ">     
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#basicModal">
               Add New Category
              </button>
              <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Add New Categry</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" method="POST" action="{{ route ('category.store') }}">
                            @csrf
                            <div class="col-12">
                              <label for="name" class="form-label">Name</label>
                              <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="col-12">
                                <label for="floatingTextarea">Description</label>
                                <textarea class="form-control" id="floatingTextarea" style="height: 100px;" name="description"></textarea>
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
        </div>
     

        <table class="table datatable">
            <thead>
                <tr>
                    <th>Sl. No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            @if($categories->count() > 0)
            @foreach($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#basicModal{{ $category->id }}">
                            Edit
                            </button>
                            <div class="modal fade" id="basicModal{{ $category->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title">Category Edit</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                            <div class="modal-body">
                                            <form class="row g-3" method="POST" action="{{ route('category.update', $category->id) }}">
                                                @csrf
                                                @method('patch')
                                                <div class="col-12">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
                                                </div>
                                                <div class="col-12">
                                                    <label for="floatingTextarea">Description</label>
                                                    <textarea class="form-control" id="floatingTextarea" style="height: 100px;" name="description">{{ $category->description }}</textarea>
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
                    </td>
                </tr>
            @endforeach
            @else
            <h4>No data</h4>
            @endif
            </tbody>
        </table>
        </div>
      </div>

    </div>
  </div>
</section>

</main><!-- End #main -->

@include('admin.partials.footer')