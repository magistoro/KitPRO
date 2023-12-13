<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script> --}}

    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> --}}
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    @vite(['resources/js/app.js', 'resources/scss/app.scss', $page_scss ?? ''])
    
    <base href="{{ asset('/') }}">
</head>
<body>
    <div class="stick-footer-wrap">


        <header class="header">
            <div class="_container">
                <div class="header__body">
                    <div class="header__top">
                        <a href="" class="header__logo"><img src="img/header/logo.svg" alt="logo"></a> 
                        
                        <div class="header__search">
                            <input type="text" name="search" id="search" placeholder="Поиск по товарам" class="form-control search-input" autocomplete="off" >
                            <a href="#" class="search-btn"><img src="img/header/search.svg" alt=""></a>
                        </div>
    
                        <a href="{{ route('login') }}" class="contact">
                            <img class="contact__icon" src="/img/header/call.svg" alt="">
    
                            <div class="contact__info-wrap">
                                <p class="contact__number">8 (977)-231-15-94</p>
                                <p class="contact__book-call">заказать звонок</p>
                            </div>
                        </a>
                    </div>
    
                    <nav class="header__nav nav">
                        @if (auth()->user())
                        @can('UserView', auth()->user())
                        <ul>
                            <li><a class="btn btn-normal btn-primary btn-primary--active" href="#">Главная</a></li>
                            <li><a class="btn btn-normal btn-primary " href="{{ route('categories.index', ['category'=> 'prodazha']) }}">Продажа</a></li>
                            <li><a class="btn btn-normal btn-primary " href="{{ route('categories.index', ['category'=> 'arenda']) }}">Аренда</a></li>
                            <li><a class="btn btn-normal btn-primary " href="#">Прайс</a></li>
                            <li><a class="btn btn-normal btn-primary " href="#">Условия аренды</a></li>
                            <li><a class="btn btn-normal btn-primary " href="#">О нас</a></li>
                            <li><a class="btn btn-normal btn-primary " href="#">Контакты</a></li>
                        </ul>
                        @endcan

                        @can('AdminView', auth()->user())
                        <ul>
                            <li><a class="btn btn-normal btn-primary btn-primary--active" href="#">Главная</a></li>
                            <li><a class="btn btn-normal btn-primary " href="{{ route('categories.index', ['category'=> 'prodazha']) }}">Продажа</a></li>
                            <li><a class="btn btn-normal btn-primary " href="{{ route('categories.index', ['category'=> 'arenda']) }}">Аренда</a></li>
                            <li><a class="btn btn-normal btn-primary " href="#">Корпоративные условия</a></li>
                            <li><a class="btn btn-normal btn-primary " href="#">Наша команда</a></li>
                            <li><a class="btn btn-normal btn-primary " href="#">Корпоративная этика</a></li>
                        </ul>
                        @endcan    
                        @else
                        <ul>
                            <li><a class="btn btn-normal btn-primary btn-primary--active" href="#">Главная</a></li>
                            <li><a class="btn btn-normal btn-primary " href="{{ route('categories.index', ['category'=> 'prodazha']) }}">Продажа</a></li>
                            <li><a class="btn btn-normal btn-primary " href="{{ route('categories.index', ['category'=> 'arenda']) }}">Аренда</a></li>
                            <li><a class="btn btn-normal btn-primary " href="#">Прайс</a></li>
                            <li><a class="btn btn-normal btn-primary " href="#">Условия аренды</a></li>
                            <li><a class="btn btn-normal btn-primary " href="#">О нас</a></li>
                            <li><a class="btn btn-normal btn-primary " href="#">Контакты</a></li>
                        </ul>
                        <a href="{{ route('cartIndex') }}" 
                        class="btn btn-normal btn-primary cart-btn"><img src="/img/header/shopping-cart.svg" alt="">Корзина</a> 
                        @endif

                        @can('UserView', auth()->user())
                        <a href="{{ route('cartIndex') }}" 
                        class="btn btn-normal btn-primary cart-btn"><img src="/img/header/shopping-cart.svg" alt="">Корзина</a> 
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                         @csrf
                     </form>
                     @endcan

                     @can('AdminView', auth()->user())
                     <a href="{{ route('admin.index') }}" 
                     class="btn btn-normal btn-primary cart-btn"><img src="/img/header/shopping-cart.svg" alt="">Админка</a> 
                  @endcan
                    </nav>  
                </div>
            </div>
        </header>
    
        {{-- ================================ --}}
        <main class="main">
    
            @yield('content')
    
        </main>
        {{-- ================================ --}}
    
        <footer class="footer">
            <div class="_container">
                <div class="footer__body">

                    <div class="footer__main">

                        <div class="footer__nav nav">
                            <div class="nav__column">
                                <p class="title">Компания</p>
                                <ul>
                                        <li><a href="">О компании</a></li>
                                        <li><a href="">Новости</a></li>
                                        <li><a href="">Магазины</a></li>
                                </ul>
                            </div>
        
                            <div class="nav__column">
                                <p class="title">Помощь</p>
                                <ul>
                                    <li><a href="">Помощь</a></li>
                                    <li><a href="">Условия оплаты</a></li>
                                    <li><a href="">Условия доставки</a></li>
                                    <li><a href="">Гарантия на товар</a></li>
                                </ul>
                            </div>
    
                            <div class="nav__column">
                                <p class="title">Информация</p>
                                <ul>
                                    <li><a href="">Статьи</a></li>
                                    <li><a href="">Вопрос-ответ</a></li>
                                    <li><a href="">Производители</a></li>
                                </ul>
                            </div>
                        </div>
    
                        <div class="footer__get-in-touch">
                            <a href="#" class="contact">
                                <img class="contact__icon" src="/img/header/call.svg" alt="">
        
                                <div class="contact__info-wrap">
                                    <p class="contact__number">8 (977)-231-15-94</p>
                                    <p class="contact__book-call">заказать звонок</p>
                                </div>
                            </a>
    
                            <div class="social">
                                <p>Мы в социальных сетях:</p>
                                <ul>
                                    <li><a href="#"><img src="/img/footer/VK.svg" alt="VK"></a></li>
                                    <li><a href="#"><img src="/img/footer/YT.svg" alt="YouTube"></a></li>
                                </ul>
                            </div>
                        </div>
    
                    </div>
    
                    <p class="footer__privacy">2023 © КИТ ПРО ТВ</p>
                </div>
            </div>
        </footer>
    </div>
</body>
