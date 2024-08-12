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
                        <td>{{ $bid->id }}</td>
                        <td>{{ $bid->item->name }}</td>
                        <td>{{ $bid->amount }}</td>
                        <td>{{ $bid->bid_time }}</td>
                        <td><span class="badge @if($bid->status == 'bidding stage') bg-warning
                            @elseif($bid->status == 'won') bg-success 
                            @elseif($bid->status == 'lost') bg-danger 
                            @elseif($bid->status == 'closed') bg-secondary 
                            @else bg-info @endif">{{$bid->status}}</span></td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#basicModal">
                            user details
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

@include('admin.partials.footer')