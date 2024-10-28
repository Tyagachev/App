<x-mail::message>
    <h3>Hi {{ $user->name }}</h3>
    <h4>Логин: {{ $user->email }}</h4>
    <h4>Пароль: {{ $password }}</h4>
    {{ config('app.name') }}
</x-mail::message>
