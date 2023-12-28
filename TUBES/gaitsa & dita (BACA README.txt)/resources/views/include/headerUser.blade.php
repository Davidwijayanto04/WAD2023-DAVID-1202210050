<!-- headerUser.blade.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{ route('user.home') }}">{{ config('app.name') }}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      @auth
      <li class="nav-item">
        <a class="nav-link" href="{{ route('user.home') }}">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('user.tenants') }}">Tenants</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('user.order.status') }}">Order Status</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
      </li>
      @endauth
    </ul>
    <span class="navbar-text">@auth{{auth()->user()->name}} ({{auth()->user()->role}})@endauth</span>
  </div>
</nav>
