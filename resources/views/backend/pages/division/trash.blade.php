@extends('backend.layout.template')

@section('page-title')
    <title>View Trash All Divisions | Ecommerce Portal</title>     
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
                            <h5 class="mb-0">View Trash All Divisions</h5>
                        </div>
                        <div class="dropdown options ms-auto">
                            <div>
                                <a href="{{ route('division.manage') }}" class="btn btn-primary btn-sm">View Active Division</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    @if( $divisions->count() > 0 )
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-border" id="example2">
                                <thead class="table-dark">
                                    <tr>
                                    <th scope="col">#SL.</th>
                                    <th scope="col">Division Name</th>
                                    <th scope="col">Priority Number</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php $i=1; @endphp
                                    @foreach($divisions as $division)
                                        <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td>{{ $division->name }}</td>
                                        <td>{{ $division->priority_num }}</td>
                                        <td>
                                            @if( $division->status == 1 )
                                                <span class="badge bg-primary">Active</span>
                                            @elseif( $division->status == 0 )
                                                <span class="badge bg-warning">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="action-bar">
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('division.edit', $division->id) }}">
                                                            <i class="lni lni-pencil-alt"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="" data-bs-toggle="modal" data-bs-target="#deleteDivision{{ $division->id }}" >
                                                            <i class="lni lni-trash"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
<!-- Modal -->
<div class="modal fade" id="deleteDivision{{ $division->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you confirm to delect this Division?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="action-bar">
                    <ul>
                        <li>
                            <form action="{{ route('division.destroy', $division->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Yes</button>
                            </form>
                        </li>
                        <li>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
                                        </tr>
                                        @php $i++; @endphp
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    @else
                       <div class="alert alert-info">Sorry! No Data Found in System Database</div>
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