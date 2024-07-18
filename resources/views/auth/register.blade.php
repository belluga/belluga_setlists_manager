@extends('layouts.auth', [
    'headline' => 'Bem vindo!',
    'subheadline' => 'Preencha os dados abaixo e crie sua conta!',
])

@section('form')
    <form role="form" method="post" action="{{ route('register') }}" id="signup">
        @csrf
        <div class="flex flex-row">
            <x-auth.textfield label="Nome" name="first_name" placeholder="Fulano" />
            <div class="w-4"></div>
            <x-auth.textfield label="Sobrenome" name="last_name" placeholder="de Tal" />
        </div>
        <x-auth.textfield label="Email" name="email" placeholder="seumelhor@email.com" />
        <x-auth.textfield label="Senha" name="password" placeholder="******" type="password" />
        <x-auth.textfield label="Confirme sua Senha" name="password_confirmation" placeholder="******" type="password" />

        <div class="min-h-6 mb-0.5 block pl-12">
            <x-auth.checkbox name="remember" label="Continuar logado" checked="true" />
        </div>
        <div class="text-center">
            <x-auth.submit_button label="Entrar" form="signup" />
        </div>
    </form>
@endsection

@section('auth_navigation')
    <x-auth.authnav label="Ainda não tem uma conta?" cta="Cadastre-se" route="register" />
@endsection
