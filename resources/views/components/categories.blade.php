<div class="nav-links">
  <div class="container-fluid">
    <div class="d-flex flex-wrap justify-content-between align-items-center">
      <ul class="nav mb-2 mb-lg-0">
    <li class="nav-item"><a class="nav-link {{ request()->routeIs('politics') ? 'active' : '' }}" href="{{ route('politics') }}">Politics</a></li>
    <li class="nav-item"><a class="nav-link {{ request()->routeIs('technology') ? 'active' : '' }}" href="{{ route('technology') }}">Technology</a></li>
    <li class="nav-item"><a class="nav-link {{ request()->routeIs('health') ? 'active' : '' }}" href="{{ route('health') }}">Health</a></li>
    <li class="nav-item"><a class="nav-link {{ request()->routeIs('sports') ? 'active' : '' }}" href="{{ route('sports') }}">Sports</a></li>
    <li class="nav-item"><a class="nav-link {{ request()->routeIs('crime') ? 'active' : '' }}" href="{{ route('crime') }}">Crime</a></li>
    <li class="nav-item"><a class="nav-link {{ request()->routeIs('science') ? 'active' : '' }}" href="{{ route('science') }}">Science</a></li>
    <li class="nav-item"><a class="nav-link {{ request()->routeIs('economic') ? 'active' : '' }}" href="{{ route('economic') }}">Economic</a></li>
    <li class="nav-item"><a class="nav-link {{ request()->routeIs('travel') ? 'active' : '' }}" href="{{ route('travel') }}">Travel</a></li>
</ul>

      <div>
        
      </div>
    </div>
  </div>
</div>