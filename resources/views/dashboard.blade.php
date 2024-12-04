<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<x-app-layout class="text">


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid">
                    <p class="mb-4" style="margin-top: 50px">Olá <strong>{{ Auth::user()->name }}</strong></p>
                    <p class="mb-4" style="font-weight: 900;">BEM VINDO AO <br>SMK ENTERPRISE </p>

                    <p class="button">
                        <a href="{{ route('product.create') }}" class="button-dashboard">Cadastrar Imagens</a>
                        <a href="{{ route('product.index') }}" class="button-dashboard">Ver Imagens</a>
                    </p>
                    <div class="imagens">
                        <div class="primeira">
                            <div class="img-style">
                                <img class="imagem" src="{{ asset('img/image_robo.png') }}" alt="Imagem ilustrativa">
                            </div>
                            <div class="img-style">
                                <img class="imagem" src="{{asset('img/astro.png')}}" alt="Imagem ilustrativa">
                            </div>
                        </div>
                        <div class="segunda">
                            <div class="img-style">
                                <img class="imagem" src="{{asset('img/image_lampada.png')}}" alt="Imagem ilustrativa">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>