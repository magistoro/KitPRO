@extends('layouts.main')

@section('content')
<section class="home">
    <div class="_container">
        <div class="home__body">
          <h1>Профиль</h1>
          {{-- <a class="dropdown-item" href="{{ route('logout') }}"
          onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                        >
           {{ __('Logout') }}
       </a> --}}




       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    
        <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
            {{ __('Loggout') }}
        </a>

        
        </div>
    </div>
</section>
@endsection