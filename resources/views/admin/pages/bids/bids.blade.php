@include('admin.partials.navbar')

<main id="main" class="main">

<div class="pagetitle">
<h1>Bids</h1>
<nav>
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
    <li class="breadcrumb-item">Tables</li>
    <li class="breadcrumb-item active">bid</li>
    </ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
    <div class="col-lg-12">
    
    <div class="card">

        <div class="card-body"> 
            
        <h5 class="card-title">Bids</h5>

        <div class="float-righ">     
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#reportModal">
            Single Report
        </button>

            <div class="modal fade" id="reportModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Report</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="row g-3" method="GET" action="{{ route('item.report') }}">
                                @csrf
                                <div class="col-12">
                                <select class="form-select" id="refDate" name="refDate" required>
                                        <option value="">Choose...</option>
                                        @foreach ($refDates as $date)
                                            <option value="{{ $date->id }}">
                                                {{ $date->auction_reference_date }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <select class="form-select" id="item" name="item_id" required>
                                        <option value="">Choose...</option>
                                       
                                    </select>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Generate</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#bulkReportModal">
            Bulk Report
        </button>

        <div class="modal fade" id="bulkReportModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Report</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="row g-3" method="GET" action="{{ route('item.bulk.report') }}">
                                @csrf
                                <div class="col-12">
                                <select class="form-select" id="refDate" name="refDate" required>
                                        <option value="">Choose...</option>
                                        @foreach ($refDates as $date)
                                            <option value="{{ $date->id }}">
                                                {{ $date->auction_reference_date }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Generate</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table with stripped rows -->
        <table class="table datatable">
            <thead>
                <tr>
                    <th>Sl.No</th>
                    <th>
                    <b>I</b>tem
                    </th>
                    <th>Amount</th>
                    <th>Bid Time</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($bids as $bid)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $bid->item->name }}</td>
                        <td>{{ number_format($bid->amount) }}</td>
                        <td>{{ $bid->bid_time }}</td>
                        <td><span class="badge @if($bid->status == 'bidding stage') bg-warning
                            @elseif($bid->status == 'wins in Bidding') bg-success 
                            @elseif($bid->status == 'loose in Bidding') bg-danger 
                            @elseif($bid->status == 'closed') bg-secondary 
                            @else bg-info @endif">{{$bid->status}}</span></td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#basicModal">
                            <i class="bi bi-eye"></i>
                            </button>
                            <div class="modal fade" id="basicModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">User Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <p class="form-control-plaintext">{{ $bid->user->name }}</p>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">CID</label>
                                                <p class="form-control-plaintext">{{ $bid->user->cid }}</p>
                                            </div>
                                        </div>
                                        <!-- <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div> -->
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

<script>
    var refDateDropdown = document.getElementById('refDate');
    var itemDropdown = document.getElementById('item');

    refDateDropdown.addEventListener('change', function() {
        var refDateId = this.value;
        console.log('refDate', refDateId);

        itemDropdown.innerHTML = '';

        fetch('/items/' + refDateId)
            .then(function(response) {
                if(!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(function(data) {
                var items = data.items;

                var defaultOption = document.createElement('option');
                defaultOption.value = item.id;
                defaultOption.textContent = item.name;
                itemDropdown.appendChild(defaultOption);

                items.forEach(function(item) {
                    var option = document.createElement('option');
                    option.value = item.id;
                    option.textContent = item.name;
                    itemDropdown.appendChild(option);
                })
            })
            .catch(function(error) {
                console.error('Error fetching items', error);
            })
    })
</script>

@include('admin.partials.footer')