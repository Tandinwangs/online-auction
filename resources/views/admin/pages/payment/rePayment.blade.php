@include('admin.partials.navbar')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
       $(document).ready(function () {
        $('input[type="checkbox"][id^="statusSwitch-"]').change(function () {
            var refund_status = $(this).is(':checked') ? 1 : 0; // Get the checked/unchecked value
            var payment_id = $(this).attr('id').split('-')[1];  // Extract payment ID from the checkbox ID

            $.ajax({
                url: '/repayments/' + payment_id + '/update-refund-status', // Define the route to handle the update
                method: 'PATCH',
                data: {
                    _token: '{{ csrf_token() }}', // Include CSRF token for security
                    refund_status: refund_status
                },
                success: function (response) {
                    alert(response.message); // Optional: Show a success message
                },
                error: function (xhr) {
                    alert('An error occurred. Please try again.'); // Handle any errors
                }
            });
        });
    });


  </script>

<main id="main" class="main">

<div class="pagetitle">
  <h1>Re Payment</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Tables</li>
      <li class="breadcrumb-item active">Re-Payment</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      
      <div class="card">
 
        <div class="card-body"> 
          <h5 class="card-title">Re-Payment Records</h5>
        <table class="table datatable">
            <thead>
                <tr>
                    <th>Sl. No</th>
                    <th>User Name</th>
                    <th>Item</th>
                    <th>Refund Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($users->count() > 0)
                    @foreach($users as $payment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $payment->user->name }}</td>
                            <td>{{ $payment->auctionReference->auction_reference_date }}</td>
                            <td>
                                <span class="badge 
                                    @if($payment->refund_status == 0) bg-warning
                                    
                                    @else bg-success @endif">
                                    {{ $payment->refund_status === 0 ? 'Not Paid' : 'Paid' }}
                                </span>
                            </td>
                            <td>
                            <form method="POST" action="{{ route('update-refund-status', $payment->id) }}">
                                @csrf
                                @method('PATCH')
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="statusSwitch" name="refund_status"
                                        value="1" {{ $payment->refund_status == 1 ? 'checked' : '' }}
                                        onchange="this.form.submit()"> <!-- Submit form when checkbox is changed -->
                                    <label class="form-check-label" for="statusSwitch">
                                        {{ $payment->refund_status == 1 ? 'Refund Processed' : 'Refund Pending' }}
                                    </label>
                                </div>
                            </form>

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


@include('admin.partials.footer')
