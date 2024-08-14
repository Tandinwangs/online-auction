@include('admin.partials.navbar')

<main id="main" class="main">

<div class="pagetitle">
  <h1>Categories</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Tables</li>
      <li class="breadcrumb-item active">payment</li>
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
               Add New payment
              </button>
              <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Add New Categry</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" method="POST" action="">
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
                    <th>User Name</th>
                    <th>Item</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            @if($payments->count() > 0)
            @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->id }}</td>
                    <td>{{ $payment->user->name }}</td>
                    <td>{{ $payment->item->name }}</td>
                    <td ><span class="badge @if($payment->status == 'pending') bg-warning
                            @elseif($payment->status == 'approved') bg-success 
                            @elseif($payment->status == 'rejected') bg-danger 
                            @elseif($payment->status == 'closed') bg-secondary 
                            @else bg-info @endif">{{$payment->status}}</span></td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#basicModal{{ $payment->id }}">
                            Edit
                            </button>
                            <div class="modal fade" id="basicModal{{ $payment->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title">Please verify and approve the payment </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                            <div class="modal-body">
                                            <form class="row g-3" method="POST" action="{{ route ('payment.update', $payment->id) }}">
                                                @csrf
                                                @method('patch')
                                                <div class="col-12">
                                                    <img class="payment-img" src="{{asset ($payment->screenshot) }}" alt="{{ $payment->name }}">
                                                </div>

                                                <div class="col-12">
                                                    <label for="status">Payment Status</label>
                                                    <select name="status" id="status" class="form-control">
                                                        <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="approved" {{ $payment->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                                        <option value="rejected" {{ $payment->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                                    </select>
                                                </div>

                                                 <!-- Reason Field -->
                                                <div class="col-12" id="reason-field" style="{{ $payment->status === 'rejected' ? '' : 'display:none;' }}">
                                                    <label for="reason">Reason</label>
                                                    <textarea name="reason" id="reason" class="form-control">{{ old('reason', $payment->reason) }}</textarea>
                                                    @error('reason')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                               
                                                <div class="text-center">
                                                <button type="submit" class="btn btn-primary">Update Status</button>
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

</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var statusSelect = document.getElementById('status');
        var reasonField = document.getElementById('reason-field');

        // Function to toggle the visibility of the reason field
        function toggleReasonField() {
            if (statusSelect.value === 'rejected') {
                reasonField.style.display = '';
            } else {
                reasonField.style.display = 'none';
            }
        }

        // Initial check on page load
        toggleReasonField();

        // Add event listener to update reason field visibility on status change
        statusSelect.addEventListener('change', toggleReasonField);
    });
</script>

@include('admin.partials.footer')