@extends('layouts.main')

@section('content')
<section class="home">
    <div class="_container">
        <div class="home__body">
          <h1>Профиль</h1>
          <a class="dropdown-item" href="{{ route('logout') }}"
          onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
           {{ __('Logout') }}
       </a>
        </div>
    </div>
</section>
@endsection