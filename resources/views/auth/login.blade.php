@extends('layouts.auth', [
    'headline' => 'Bem vindo de volta!',
    'subheadline' => 'Digite seu email e senha para acessar sua conta',
])

@section('form')
    <form role="form" method="post" action="{{ route('login') }}" id="login">
        @csrf
        <x-auth.textfield label="Email" name="email" placeholder="seumelhor@email.com" />
        <x-auth.textfield label="Senha" name="password" placeholder="******" type="password" />

        <div class="min-h-6 mb-0.5 block pl-12">
            <x-auth.checkbox name="remember" label="Continuar logado" checked="true" />
        </div>
        <div class="text-center">
            <x-auth.submit_button label="Entrar" form="login" />
        </div>
    </form>
@endsection

@section('auth_navigation')
    <x-auth.authnav label="Ainda não tem uma conta?" cta="Cadastre-se" route="register" />
@endsection
