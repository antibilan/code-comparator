@extends('layouts.layout')

@section('topcontent')
<div class="container-fluid">
	<div class="row">
		<div class="col"></div>
		
		<div class="col">
			<form method='post' id="uploadForm" enctype="multipart/form-data" action="{{ route('upload') }}">		
				@csrf
				<div class="mb-3">
					<label for="fileCompany" class="form-label">Выберите файл предприятия</label>
					<input type="file" class="form-control" id="fileCompany" name="fileCompany">
					<label for="FileFKKO" class="form-label">Выберите файл ФККО</label>
					<input type="file" class="form-control" id="fileFkko" name="fileFkko">
					<div id="uploadHelp" class="form-text">Укажите путь к файлу в формате .html</div>
					<!-- <button type="submit" class="btn btn-primary">Сравнить</button> -->
				</div>						
			</form>
		</div>

		<div class="col"></div>
	</div>
</div>
@endsection

@section('onlydiff')
<div><button type="submit" class="btn btn-primary" form="uploadForm">Сравнить</button></div>
	@if(isset($results))
		<div class="row">
		@foreach($results as $key => $result)
			<div class="col">
				<div class="container-fluid">
					<table class="table table-striped">
						@if($key === 0)
							<thead>
								<tr>
									<th scope="col">Расхождения в наименованиях</td>
								</tr>
							</thead>
						@endif
						@if($key === 1)
							<thead>
								<tr>
									<th scope="col">Расхождения в кодах</td>
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
<div><button type="submit" class="btn btn-primary" form="uploadForm">Сравнить</button></div>
<div class="col">
				<div class="container-fluid">
					<table class="table table-striped">						
						<thead>
							<tr>
								<th scope="col">заголовок</td>
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