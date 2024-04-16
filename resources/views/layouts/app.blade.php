<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
</head>
<body>
<header>
    <a href="/">Главная </a>
    <a href="/basket">Корзина </a>
    <a href="/order">Заказы </a>
    @auth
        <form action="/logout" method="post">
            @csrf
            <button type="submit">Выйти</button>
        </form>
    @else
        <a href="/login">Войти</a>
    @endauth
</header>
<main>
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    @yield('content')
</main>
<footer>
</footer>
</body>
</html>

