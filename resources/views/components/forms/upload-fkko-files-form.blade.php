<form method='post' id="uploadForm" enctype="multipart/form-data" action="{{ route('upload') }}">
    @csrf
    <div class="mb-3">
        <label for="fileCompany" class="form-label">Выберите файл предприятия</label>
        <input class="form-control" type="file" id="fileCompany" name="fileCompany">
        <label for="FileFKKO" class="form-label">Выберите файл ФККО</label>
        <input class="form-control" type="file" id="fileFkko" name="fileFkko">
        <div id="uploadHelp" class="form-text">Укажите путь к файлу в формате .html</div>
        <!-- <div class="form-control position-relative"> -->
        <button type="submit" class="btn btn-primary w-100">Сравнить</button>
        <!-- </div>         -->
    </div>
</form>