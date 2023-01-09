<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Comparator</title>
  </head>
  <body>
    <div class="row">
      
      <div class="col"></div>
      
      <div class="col-8">
        <header>
          <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid">
              <a class="navbar-brand " href="{{ route('home') }}">Сравнение кодов ФККО</a>
              <form class="d-flex" method="get" action="{{ route('search') }}">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="s" name="search">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form>
            </div>
          </nav>
        </header>

        <!-- <div class="row mb-5"></div> -->
    
        @yield('topcontent') 

        <ul class="nav nav-tabs justify-content-center nav-fill" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Только различия</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="compare-tab" data-bs-toggle="tab" data-bs-target="#compare" type="button" role="tab" aria-controls="compare" aria-selected="false">Строка к строке</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="fkko-tab" data-bs-toggle="tab" data-bs-target="#fkko" type="button" role="tab" aria-controls="fkko" aria-selected="false">ФККО</button>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row mb-5">
            </div>
            @yield('onlydiff')
          </div>
          <div class="tab-pane fade" id="compare" role="tabpanel" aria-labelledby="compare-tab">
            <div class="row mb-5">
            </div>
            @yield('sydebyside')
          </div>
          <div class="tab-pane fade" id="fkko" role="tabpanel" aria-labelledby="fkko-tab">
            <div class="row mb-5">
            </div>
            @yield('fkko')
          </div>
        </div>
      </div>

      <div class="col"></div>
    </div>
 
     <!-- JavaScript Bundle with Popper -->
     <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>