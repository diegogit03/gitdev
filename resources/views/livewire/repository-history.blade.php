<div class="bg-white w-full p-5">
    <h1>Commits</h1>
    <hr>
    <div class="mt-3">
        <div>
            @foreach ($timeline as $time)
                <!-- Heading -->
                <div class="ps-2 my-2 first:mt-0">
                    <h3 class="text-xs font-medium uppercase text-gray-500 dark:text-gray-400">
                        {{ $time['date'] }}
                    </h3>
                </div>
                <!-- End Heading -->

                @foreach ($time['commits'] as $commit)
                    <!-- Item -->
                    <div class="flex gap-x-3">
                        <!-- Icon -->
                        <div class="relative last:after:hidden after:absolute after:top-7 after:bottom-0 after:start-3.5 after:w-px after:-translate-x-[0.5px] after:bg-gray-200 dark:after:bg-gray-700">
                        <div class="relative z-10 w-7 h-7 flex justify-center items-center">
                            <div class="w-2 h-2 rounded-full bg-gray-400 dark:bg-gray-600"></div>
                        </div>
                        </div>
                        <!-- End Icon -->

                        <!-- Right Content -->
                        <div class="grow pt-0.5 pb-8">
                        <h3 class="flex gap-x-1.5 font-semibold text-gray-800 dark:text-white">
                            <svg class="flex-shrink-0 w-4 h-4 mt-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><line x1="10" x2="8" y1="9" y2="9"/></svg>
                            {{ $commit['description'] }}
                        </h3>
                        <button type="button" class="mt-1 -ms-1 p-1 inline-flex items-center gap-x-2 text-xs rounded-lg border border-transparent text-gray-500 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                            {{ $commit['author'] }}
                        </button>
                        </div>
                        <!-- End Right Content -->
                    </div>
                    <!-- End Item -->
                @endforeach
            @endforeach
        </div>
    </div>
</div>
