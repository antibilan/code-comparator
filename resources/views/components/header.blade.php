<header>
    <nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand " href="{{ route('home') }}">Сравнение кодов ФККО</a>
        <form class="d-flex" method="get" action="{{ route('search') }}">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="s" name="search">
        <button class="btn btn-outline-success" type="submit">Search</button>
        </form>

        <x-inputs.dropdown new-project-name="New project test">
            {{ $component->myFunc('hello') }}
            <x-slot name="bla">   
                Контент             
            </x-slot>
        </x-inputs.dropdown>

    </div>
    </nav>
</header>