<div class="dropdown">
    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="https://avatars.githubusercontent.com/u/22330934" alt="hugenerd" width="30" height="30" class="rounded-circle">
        <span class="d-none d-sm-inline mx-1">{{Auth::user()->email}}</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
        <li><a class="dropdown-item" href="#">{{ $newProjectName }}</a></li>
        <li><a class="dropdown-item" href="#">Settings</a></li>
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li>
            <hr class="dropdown-divider"> 
        </li>
        <li><a class="dropdown-item" href="#">{{ $bla ?? '' }}</a></li>
        <li><a class="dropdown-item" href="{{ route('logout') }}">Sign out</a></li>
        {{ $slot }}
    </ul>
</div>