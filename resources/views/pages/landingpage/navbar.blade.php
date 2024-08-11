<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
    <h5 class="my-0 mr-md-auto font-weight-normal">Perpustakaan Digital</h5>
    <nav class="my-2 my-md-0 mr-md-3">
    </nav>
    @if (Auth::check())
        <a class="btn btn-outline-primary" href="{{ route('home') }}">Dashboard</a>
    @else
        <div class="">
            <a class="btn btn-outline-primary" href="{{ route('login') }}">Login</a>
        </div>
        <div class="ml-3">
            <a class="btn btn-outline-primary" href="{{ route('register') }}">Register</a>
        </div>
    @endif
  </div>
