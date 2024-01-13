<div class="bg-white w-full p-5">
    <form wire:submit='create'>
        <h1 class="mb-2">Criar novo repositório</h1>
        <div class="mb-2">
            <label for="title" class="block text-sm font-medium text-gray-700 leading-5">
                Titulo do repositório
            </label>

            <div class="mt-1 rounded-md shadow-sm">
                <input wire:model="title" id="title" name="title" type="text" required autofocus class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
            </div>

            @error('title')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex justify-end">
            <button type="submit" class="flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                Criar
            </button>
        </div>
    </form>
</div>
