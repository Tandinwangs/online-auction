<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Report</title>

<style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header img {
            width: 80px;
        }
        .header .title {
            text-align: center;
            flex-grow: 2;
        }
        .header .title h2, .header .title h3 {
            margin: 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 4px;
            text-align: left;
        }
        .table th {
            background-color: #252D60;
            color: #ffffff;
            font-size: 14px; 
        }

        .table td{
            font-size: 12px; 
        }
        .signature-section {
            margin-top: 30px;
        }

        .signature-section p{
            font-size: 12px; 
        }
        .signature-left, .signature-right {
            width: 50%;
            float: left;
        }
        .signature-right {
            text-align: right;
        }
        .clear {
            clear: both;
        }
        .footer-section {
            margin-top: 50px;
            text-align: center;
        }
        .footer-section div {
            display: inline-block;
            width: 30%;
            text-align: center;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div><img src="assets/admin/img/logo.png" alt="Logo"></div>
        <div class="title">
            <h3>BHUTAN NATIONAL BANK</h3>
            <h4>THIMPHU, BHUTAN</h4>
            <h5>STATEMENT OF THE PROPERTY AUCTIONED ON {{ $item->auctionReference->auction_reference_date }}</h5>
            <h5>Property: {{ $item->name }}</h5>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Sl.No</th>
                <th>CID</th>
                <th>Rank</th>
                <th>Bid Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bids as $index => $bid)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $bid->user->cid }}</td>
                <td>{{ $bid->rank }}</td>
                <td>{{ $bid->highest_bid }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

 <!-- Additional content below the table -->
 <div class="signature-section">
        <div class="signature-left">
            <p>Name of the Highest Bidder: {{ $highestBidder->user->name }}</p>
            <p>Signature:</p>
            <p>Cid No: {{ $highestBidder->user->cid }}</p>
            <p>Phone No: {{ $highestBidder->user->phone_numer }}</p>
        </div>
        <div class="signature-right">
            <p>Signature of auction committee:</p>
        </div>
        <div class="clear"></div>
    </div>

    <!-- Footer content -->
    <div class="footer-section">
        <div>Chief RMD</div>
        <div>Sr. RTO</div>
        <div>Director, Banking Operations</div>
        <div>Bhutan National Bank</div>
        <div>BCTA, Thimphu</div>
        <div>Bhutan National Bank Ltd</div>
    </div>
    <div class="footer-section">
        <div>Chief Executive Officer <br> Bhutan National Bank</div>
    </div>
</body>
</html>







