<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Produtos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="grid grid-cols-4 gap-4 p-6" id="photo-position">
                    @foreach($products as $product)
                    <div class="photos">
                        <figure>
                            <img class="img-index"
                                src="{{ asset('storage/' . $product->product_file_name) }}"
                                alt="[imagem]"
                                data-id="{{ $product->id }}"
                                data-image="{{ asset('storage/' . $product->product_file_name) }}"
                                onclick="openPopup(this)">
                        </figure>
                    </div>
                    @endforeach
                </div>

                <!-- Popup -->
                <div id="imagePopup" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center">
                    <div id="pop-up" class="relative bg-white p-4 rounded-lg flex flex-col items-center">
                        <!-- Botão para fechar -->
                        <button class="absolute text-red-500" style="left: 15px; top: 10px;" onclick="closePopup()">X</button>

                        <!-- Imagem no popup -->
                        <img id="popupImage" src="" alt="[imagem em destaque]" class="max-w-full max-h-[80vh] object-contain mb-4">
                        <!-- Botões -->
                        <div id="buttons" class="flex space-x-4">
                            <!-- Botão para baixar a imagem -->
                            <a id="downloadButton" href="" download="produto-imagem.jpg"
                                class="text-white px-4 py-2 rounded-lg"
                                style="background-color: #20385D;">
                                Baixar Imagem
                            </a>

                            <!-- Botão para excluir a imagem -->
                            <button id="deleteButton" class="bg-red-500 text-white px-4 py-2 rounded-lg" style="margin-left: 10px;" onclick="showConfirmBox()">Excluir Imagem</button>
                        </div>

                        <!-- Caixa de confirmação -->
                        <div id="confirmBox" class="hidden mt-4 flex flex-col items-center">
                            <p class="text-gray-800 mb-4">Tem certeza que deseja excluir esta imagem?</p>
                            <div class="flex space-x-4">
                                <button class="bg-gray-500 text-white px-4 py-2 rounded-lg" onclick="confirmDelete()">Sim</button>
                                <button style="margin-left: 10px;" class="bg-gray-500 text-white px-4 py-2 rounded-lg" onclick="hideConfirmBox()">Não</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        // Abre o popup e exibe a imagem clicada
        function openPopup(imageElement) {
            const popup = document.getElementById('imagePopup');
            const popupImage = document.getElementById('popupImage');
            const downloadButton = document.getElementById('downloadButton');
            const deleteButton = document.getElementById('deleteButton');

            const imageUrl = imageElement.getAttribute('data-image'); // Obtém a URL da imagem clicada
            const productId = imageElement.getAttribute('data-id'); // Obtém o ID do produto
            popupImage.src = imageUrl; // Atualiza a imagem do popup
            downloadButton.href = imageUrl; // Atualiza o link de download com a URL da imagem
            deleteButton.setAttribute('data-id', productId); // Atribui o ID ao botão de exclusão
            popup.classList.remove('hidden'); // Mostra o popup
        }

        // Fecha o popup
        function closePopup() {
            const popup = document.getElementById('imagePopup');
            const confirmBox = document.getElementById('confirmBox');
            confirmBox.classList.add('hidden'); // Esconde a caixa de confirmação se estiver visível
            popup.classList.add('hidden'); // Oculta o popup
        }

        // Mostra a caixa de confirmação
        function showConfirmBox() {
            const buttons = document.getElementById('buttons');
            const confirmBox = document.getElementById('confirmBox');
            buttons.classList.add('hidden'); // Esconde os botões principais
            confirmBox.classList.remove('hidden'); // Mostra a caixa de confirmação
        }

        // Esconde a caixa de confirmação
        function hideConfirmBox() {
            const buttons = document.getElementById('buttons');
            const confirmBox = document.getElementById('confirmBox');
            confirmBox.classList.add('hidden'); // Esconde a caixa de confirmação
            buttons.classList.remove('hidden'); // Mostra os botões principais
        }

        // Confirma a exclusão da imagem
        function confirmDelete() {
            const productId = document.getElementById('deleteButton').getAttribute('data-id');

            fetch(`/product/${productId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Imagem excluída com sucesso');
                    closePopup();
                    location.reload(); // Recarrega a página para atualizar a lista de produtos
                } else {
                    alert('Erro ao excluir a imagem');
                }
            });
        }
    </script>
</x-app-layout>
