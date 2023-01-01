@extends('layouts.dashboard')

@section('content')
<div class="card">
	<div class="card-body">
		<h4>{{ $title }}</h4>

		<div class="text-right mb-3">
			<a href="{{ url('/admin/store/product/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
		</div>

		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Produk</th>
					<th>Harga</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@if(count($datas) == 0)
				<tr>
					<td colspan="5" class="text-center">Belum Ada Produk</td>
				</tr>
				@else
				@foreach($datas as $k => $v)
				<tr>
					<td>{{ $k+1 }}</td>
					<td>{{ $v->title }}</td>
					<td>{{ $v->price }}</td>
					<td>
						<a href="{{ url('admin/store/product/'.$v->id.'/edit') }}" class="btn btn-warning btn-sm">
							<i class="fa fa-edit"></i>
						</a>
						<button class="btn btn-sm btn-danger btn-delete-trigger" data-id="{{ $v->id }}">
							<i class="fa fa-trash"></i>
						</button>
					</td>
				</tr>
				@endforeach
				{{ $datas->links() }}
				@endif
			</tbody>
		</table>
	</div>
</div>

<div class="modal" id="modal-delete" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Hapus Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Yakin ingin menghapus data ?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-delete">Hapus</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>

<form method="post" id="form-delete">
	@csrf
	<input type="hidden" name="_method" value="DELETE">
</form>
@endsection

@push('js')
<script type="text/javascript">
	$(document).ready(function(){
		$(".btn-delete-trigger").on("click", function(){
			var id = $(this).data('id');
			$("#form-delete").attr('action', '{{ url("admin/store/product") }}'+'/'+id);
			$("#modal-delete").modal('show');
		});

		$(".btn-delete").on("click", function(){
			$("#form-delete").submit();
		});
	});
</script>
@endpush