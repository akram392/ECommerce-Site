@extends('backend.layout.template')

@section('page-title')
    <title>Update Division Information | Ecommerce Portal</title>
@endsection

@section('body-css')

@endsection

@section('body-content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">View Order Information</h5>
                        </div>
                        <div class="dropdown options ms-auto">
                            <div>
                                <a href="{{ route('all.orders') }}" class="btn btn-primary btn-sm">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="order-details-box">
                                    <h3>Order ID: #{{ $order->id }}</h3>
                                    <p>Date: {{ $order->order_date }}</p>
                                    <p>Status:
                                        @if ( $order->status == 'Successful' )
                                            <span class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Successful</span>
                                        @elseif( $order->status == 'Pending' )
                                            <span class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3"><i class="bx bxs-circle align-middle me-1"></i>Pending</span>
                                        @elseif( $order->status == 'Canceled' )
                                            <span class="badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3"><i class="bx bxs-circle align-middle me-1"></i>Canceled</span>
                                        @elseif( $order->status == 'Processing' )
                                            <span class="badge rounded-pill text-primary bg-light-primary p-2 text-uppercase px-3"><i class="bx bxs-circle align-middle me-1"></i>Processing</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="order-details-box">
                                    <h3>Customer Name</h3>
                                    <p>{{ $order->name }}</p>
                                    <p>{{ $order->email }}</p>
                                    <p>{{ $order->phone }}</p>
                                    <p>{{ $order->address_line1 }}, {{ $order->address_line2 }}</p>
                                    <p>{{ $order->district->name }}, {{ $order->division->name }}, {{ $order->zipCode }}</p>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="order-details-box">
                                    <h3>Order Amount</h3>
                                    <p>Amount: <strong>{{ $order->total_amount }} BDT</strong></p>
                                    <p>Transaction ID: <strong>
                                        @if ( !is_null( $order->transaction_id ) )
                                            {{ $order->transaction_id }}
                                        @else
                                            Cash On Delivery
                                        @endif </strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="order-details-box">
                                    <h3>Order Details</h3>
                                    <div class="table-responsive">
                                        <table class="table mb-0" id="example2">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>#Sl.</th>
                                                    <th>Product Title</th>
                                                    <th>Quantity</th>
                                                    <th>Unit Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $sl = 1; @endphp
                                                @foreach ($products as $product)
                                                    <tr>
                                                        <td>{{ $sl; }}</td>
                                                        <td>{{ $product->product->title }}</td>
                                                        <td>{{ $product->quantity }} Pcs</td>
                                                        <td>{{ $product->unit_price }} BDT</td>
                                                    </tr>
                                                    @php $sl++ ; @endphp
                                                @endforeach
                                                <tr>
                                                    <td colspan="3" ><strong>Total Amount:</strong></td>
                                                    <td><strong>{{ $order->total_amount }} BDT</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="order-details-box">
                                    <h3>Order Status</h3>
                                    <form action="{{ route('order.update', $order->id) }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="">Order Status</label>
                                            <select name="status" class="form-control">
                                                <option >Update the Order Status</option>
                                                <option value="Pending" @if ( $order->status == 'Pending' ) selected @endif >Pending</option>
                                                <option value="Processing" @if ( $order->status == 'Processing' ) selected @endif >Processing</option>
                                                <option value="Successful" @if ( $order->status == 'Successful' ) selected @endif >Successful</option>
                                                <option value="Canceled" @if ( $order->status == 'Canceled' ) selected @endif >Canceled</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <input type="submit" name="submit" value="Save Changes" class="btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('body-script')
    <script src="{{ asset('backend/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('backend/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );

			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>
@endsection
