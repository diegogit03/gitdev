<div class="bg-white w-full p-5">
    <div class="flex justify-between items-center mb-5">
        <h1>Repositorios</h1>
        <button wire:click='create' type="button" class="flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
            Criar novo repositorio
        </button>
    </div>
    @foreach ($this->repositories as $repository)
        <div class="flex justify-between bg-gray-100 mb-3 p-3">
            <span>
                {{ $repository->title }}
            </span>
        </div>
    @endforeach
</div>
