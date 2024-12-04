<link rel="stylesheet" href="{{ asset('css/cadastro.css') }}">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastro de Produtos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="form">
                    {{-- form --}}
                    <form class="form-cadastro" action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-cadastro-titulo">
                            <h2>Cadastro Imagem</h2>
                        </div>

                        <div class="form-cadastro-index">
                            <input class="form-cadastro-index-input" placeholder="Nome da Imagem" type="text" name="product_name" id="product_name" class="w-full rounded" required autofocus>
                        </div>

                        <div class="form-cadastro-index">
                            <label for="product_file_name">Selecione um arquivo de imagem</label>
                            <input type="file" name="product_file_name" id="product_file_name" class="w-full rounded" required>
                        </div>

                        <div class="form-cadastro-index">
                            <button type="reset" class="rounded bg-red-500 text-white py-1 px-4">Limpar</button>
                            <button style="background-color: #20385D;" type="submit" class="rounded bg-blue-500 text-white py-1 px-4">Cadastrar</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
