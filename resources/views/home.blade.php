@extends('layouts.layout')

@section('topcontent')
<div class="container-fluid">
	<div class="row">
		<div class="col"></div>

		<div class="col">
			<x-forms.upload-fkko-files-form />
		</div>

		<div class="col"></div>
	</div>
</div>
@endsection

@section('onlydiff')
<!-- <div><button type="submit" class="btn btn-primary" form="uploadForm">Сравнить</button></div> -->
	@if(isset($results))
		<div class="row">
		@foreach($results as $key => $result)
			<div class="col">
				<div class="container-fluid">
					<table class="table table-striped">
						@if($key === 0)
							<thead>
								<tr>
									<th scope="col">Расхождения в наименованиях</th>
								</tr>
							</thead>
						@endif
						@if($key === 1)
							<thead>
								<tr>
									<th scope="col">Расхождения в кодах</th>
								</tr>
							</thead>
						@endif
						@foreach ($result as $diff)
							<tbody>
								<tr>
									<td>{{ $diff }}</td>
								</tr>
							</tbody>
						@endforeach
					</table>
				</div>
			</div>
		@endforeach
		</div>
	@endif
@endsection

@section('sydebyside')
<!-- <div><button type="submit" class="btn btn-primary" form="uploadForm">Сравнить</button></div> -->
<div class="col">
				<div class="container-fluid">
					<table class="table table-striped">
						<thead>
							<tr>
								<th scope="col">заголовок</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>тело</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
@endsection
