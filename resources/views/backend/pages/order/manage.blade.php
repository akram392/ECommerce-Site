@extends('backend.layout.template')

@section('page-title')
    <title>Manage All Orders | Ecommerce Portal</title>
@endsection

@section('body-css')
    <link href="{{ asset('backend/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection

@section('body-content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">Manage All Orders</h5>
                        </div>
                        <div class="dropdown options ms-auto">
                            <div>
                                <a href="{{ route('division.trash') }}" class="btn btn-primary btn-sm">View Trash</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    @if( $orders->count() > 0 )
                        <div class="table-responsive">
                            <table class="table mb-0" id="example2">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order ID#</th>
                                        <th>Customer Name</th>
                                        <th>Phone No.</th>
                                        <th>Status</th>
                                        <th>Total Amount</th>
                                        <th>Date</th>
                                        <th>View Details</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $orders as $order )
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    {{-- <div>
                                                        <input class="form-check-input me-3" type="checkbox" value="" aria-label="...">
                                                    </div> --}}
                                                    <div class="ms-2">
                                                        <h6 class="mb-0 font-14">#{{ $order->id }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $order->name }}</td>
                                            <td>{{ $order->phone }}</td>
                                            <td>
                                                @if ( $order->status == 'Successful' )
                                                    <div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Successful</div>
                                                @elseif( $order->status == 'Pending' )
                                                    <div class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3"><i class="bx bxs-circle align-middle me-1"></i>Pending</div>
                                                @elseif( $order->status == 'Canceled' )
                                                    <div class="badge rounded-pill text-warning bg-light-danger p-2 text-uppercase px-3"><i class="bx bxs-circle align-middle me-1"></i>Canceled</div>
                                                @elseif( $order->status == 'Processing' )
                                                    <div class="badge rounded-pill text-warning bg-light-primary p-2 text-uppercase px-3"><i class="bx bxs-circle align-middle me-1"></i>Processing</div>
                                                @endif
                                            </td>
                                            <td>{{ $order->total_amount }} BDT</td>
                                            <td>{{ $order->order_date }}</td>
                                            <td><button type="button" class="btn btn-primary btn-sm radius-30 px-4">View Details</button></td>
                                            <td>
                                                <div class="d-flex order-actions">
                                                    <a href="{{ route('order.edit', $order->id ) }}" class=""><i class="bx bxs-edit"></i></a>
                                                    <a href="javascript:;" class="ms-3"><i class="bx bxs-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                       <div class="alert alert-info">Sorry! No Order Found in System Database</div>
                    @endif

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
