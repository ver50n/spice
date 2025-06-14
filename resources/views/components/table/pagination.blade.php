@php
  $rowPerPage = !empty(Session::get('rowPerPage')) ? Session::get('rowPerPage') : 30;
  $rowPerPageOptions = [30 ,50];
@endphp
<section class="component__grid-pagination">
	<div class="d-flex flex-row justify-content-between">
		<div>
			<select class="form-control form-control-sm grids-control-records-per-page"
				style="display: inline; width: 80px; margin-right: 10px;">
			@foreach($rowPerPageOptions as $rppo)
				<option value="{{ $rppo }}" @php echo ($rppo == $rowPerPage) ? "selected" : "";  @endphp>{{ $rppo }}</option>
			@endforeach
			</select>Row Per Page
		</div>
		<div>
			<span>
				Total {{$data->total()}} Record
			</span>
		</div>
	</div>
	<div class="pagination-list">
    {{$data->appends(request()->input())->links("pagination::bootstrap-4")}}
	</div>
</section>