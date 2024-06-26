<footer class="bg-gray-900 py-8 text-white border-t border-gray-800">
    <div
        class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8 flex justify-between items-center sm:flex-row flex-col gap-4">
        <div class="footer-logo">
            @include('components.logo')
            <p class="mt-2 text-sm">Project developed using <a href="https://tailwindcss.com/" target="_blank"
                    class="text-blue-300 hover:text-blue-400 transition-all duration-200">
                    Tailwind
                </a>, <a href="https://laravel.com/" target="_blank"
                    class="text-blue-300 hover:text-blue-400 transition-all duration-200">Laravel</a>
                and
                <a class="text-blue-300 hover:text-blue-400 transition-all duration-200" target="_blank"
                    href="https://developer.themoviedb.org/docs/getting-started">The Movie
                    Database</a>.
            </p>
        </div>
        <div class="flex gap-4">
            <a href="https://github.com/felipebrsk/" target="blank"
                class="text-gray-400 hover:text-white animate-bounce transition-all duration-200">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 2C6.48 2 2 6.48 2 12c0 4.94 3.63 9.02 8.35 9.77.61.11.83-.27.83-.6v-2.16c-3.39.74-4.1-1.65-4.1-1.65-.55-1.39-1.34-1.77-1.34-1.77-1.09-.74.08-.72.08-.72 1.21.09 1.85 1.24 1.85 1.24 1.08 1.84 2.83 1.31 3.52 1 .11-.78.42-1.31.76-1.61-2.67-.3-5.48-1.34-5.48-5.96 0-1.32.47-2.4 1.24-3.25-.12-.3-.54-1.54.12-3.2 0 0 1.02-.32 3.34 1.24a11.45 11.45 0 013 0c2.32-1.56 3.34-1.24 3.34-1.24.66 1.66.24 2.9.12 3.2.77.85 1.24 1.93 1.24 3.25 0 4.64-2.82 5.66-5.49 5.96.43.37.82 1.11.82 2.24v3.32c0 .33.22.72.84.6A10.02 10.02 0 0022 12c0-5.52-4.48-10-10-10z">
                    </path>
                </svg>
            </a>
            <a href="https://linkedin.com/in/felipe-luz-oliveira/" target="blank"
                class="text-gray-400 hover:text-white animate-bounce transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 24 24">
                    <path
                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 16h-2v-6h2v6zm-1-6.891c-.607 0-1.1-.496-1.1-1.109 0-.612.492-1.109 1.1-1.109s1.1.497 1.1 1.109c0 .613-.493 1.109-1.1 1.109zm8 6.891h-1.998v-2.861c0-1.881-2.002-1.722-2.002 0v2.861h-2v-6h2v1.093c.872-1.616 4-1.736 4 1.548v3.359z" />
                </svg>
            </a>
            <a href="#" class="text-gray-400 hover:text-white animate-bounce transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 24 24">
                    <path
                        d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.1.824zm-3.423-14.416c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm.029 18.88c-1.161 0-2.305-.292-3.318-.844l-3.677.964.984-3.595c-.607-1.052-.927-2.246-.926-3.468.001-3.825 3.113-6.937 6.937-6.937 1.856.001 3.598.723 4.907 2.034 1.31 1.311 2.031 3.054 2.03 4.908-.001 3.825-3.113 6.938-6.937 6.938z" />
                </svg>
            </a>
        </div>
    </div>
    <div
        class="border-t py-4 border-gray-800 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center sm:flex-row flex-col">
        <div>
            &copy; {{ \Illuminate\Support\Carbon::now()->year }}. Felipe Oliveira.
        </div>
        <div class="flex sm:gap-2 gap-0 sm:flex-row flex-col text-center">
            <a href="#" class="text-gray-400 hover:text-white transition-all duration-200">Privacy
                Policy</a>
            <span class="text-gray-400 hidden sm:block">•</span>
            <a href="#" class="text-gray-400 hover:text-white transition-all duration-200">Terms of
                Service</a>
            <span class="text-gray-400 hidden sm:block">•</span>
            <a href="#" class="text-gray-400 hover:text-white transition-all duration-200">About</a>
        </div>
    </div>
</footer>
