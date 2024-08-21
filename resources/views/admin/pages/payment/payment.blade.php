@include('admin.partials.navbar')

<main id="main" class="main">

<div class="pagetitle">
  <h1>Categories</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Tables</li>
      <li class="breadcrumb-item active">Payment</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      
      <div class="card">
 
        <div class="card-body"> 
          <h5 class="card-title">Categories</h5>
        <table class="table datatable">
            <thead>
                <tr>
                    <th>Sl. No</th>
                    <th>User Name</th>
                    <th>Reference Date</th>
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
                    <td>{{ $payment->auctionReference->auction_reference_date }}</td>
                    <td><span class="badge @if($payment->status == 'pending') bg-warning
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
                                        <h6 class="modal-title">Please verify and approve the payment</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="row g-3" method="POST" action="{{ route('payment.update', $payment->id) }}">
                                            @csrf
                                            @method('patch')

                                            <div class="col-12">
                                                <img class="payment-img" src="{{ asset($payment->screenshot) }}" alt="{{ $payment->name }}">
                                            </div>

                                            <!-- Approve Checkbox -->
                                            <div class="col-6 form-check">
                                                <input type="checkbox" name="status" id="approve-{{ $payment->id }}" class="form-check-input"
                                                    value="approved" {{ $payment->status == 'approved' ? 'checked' : '' }} onclick="toggleCheckboxes({{ $payment->id }})">
                                                <label for="approve-{{ $payment->id }}" class="form-check-label">Approve Payment</label>
                                            </div>

                                            <!-- Reject Checkbox -->
                                            <div class="col-6 form-check">
                                                <input type="checkbox" name="status" id="reject-{{ $payment->id }}" class="form-check-input"
                                                    value="rejected" {{ $payment->status == 'rejected' ? 'checked' : '' }} onclick="toggleCheckboxes({{ $payment->id }})">
                                                <label for="reject-{{ $payment->id }}" class="form-check-label">Reject Payment</label>
                                            </div>

                                            <!-- Reason Field (Visible only if rejected) -->
                                            <div class="col-12" id="reason-field-{{ $payment->id }}" style="{{ $payment->status === 'rejected' ? '' : 'display:none;' }}">
                                                <label for="reason">Reason</label>
                                                <textarea name="reason" id="reason" class="form-control">{{ old('reason', $payment->reason) }}</textarea>
                                                @error('reason')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary btn-sm">Update Status</button>
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
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
    function toggleCheckboxes(paymentId) {
    const approveCheckbox = document.getElementById(`approve-${paymentId}`);
    const rejectCheckbox = document.getElementById(`reject-${paymentId}`);
    const reasonField = document.getElementById(`reason-field-${paymentId}`);

    if (rejectCheckbox.checked) {
        approveCheckbox.checked = false;
        reasonField.style.display = 'block';
    } else {
        reasonField.style.display = 'none';
    }

    if (approveCheckbox.checked) {
        rejectCheckbox.checked = false;
        reasonField.style.display = 'none';
    }
}

</script>

@include('admin.partials.footer')
