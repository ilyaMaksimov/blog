{{--
@if(Auth::check())
    <li><a href="/profile">My profile</a></li>
    <li><a href="/logout">Logout</a></li>
@else
    <li><a href="/register">Register</a></li>
    <li><a href="/login">Login</a></li>
@endif--}}

@guest
    <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
    </li>
    @if (Route::has('register'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
    @endif
@else
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link " href="{{route('profile')}}" >
            {{ Auth::user()->getName() }}
        </a>


    </li>
    <li>
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
    </li>
@endguest