<div class="sm:w-1/4 w-full bg-gradient-to-b from-gray-900 to-gray-800 p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-4 text-yellow-500">Profile</h2>
    <ul class="flex flex-col gap-4">
        <li>
            <a href="{{ route('profiles.show') }}"
                class="{{ request()->routeIs('profiles.show') ? 'font-bold text-yellow-400 hover:text-yellow-500' : 'text-gray-300 hover:text-white' }} flex items-center gap-2">
                <i class="fas fa-user-circle"></i> Profile
            </a>
        </li>
        <li>
            <a href="{{ route('profiles.coins') }}"
                class="{{ request()->routeIs('profiles.coins') ? 'font-bold text-yellow-400 hover:text-yellow-500' : 'text-gray-300 hover:text-white' }} flex items-center gap-2">
                <i class="fas fa-coins"></i> Coins
            </a>
        </li>
        <li>
            <a href="{{ route('profiles.titles') }}"
                class="{{ request()->routeIs('profiles.titles') ? 'font-bold text-yellow-400 hover:text-yellow-500' : 'text-gray-300 hover:text-white' }} flex items-center gap-2">
                <i class="fas fa-award"></i> Titles
            </a>
        </li>
        <li>
            <a href="{{ route('profiles.transactions') }}"
                class="{{ request()->routeIs('profiles.transactions') ? 'font-bold text-yellow-400 hover:text-yellow-500' : 'text-gray-300 hover:text-white' }} flex items-center gap-2">
                <i class="fas fa-exchange"></i> Transactions
            </a>
        </li>
        <li>
            <a href="{{ route('profiles.picture') }}"
                class="{{ request()->routeIs('profiles.picture') ? 'font-bold text-yellow-400 hover:text-yellow-500' : 'text-gray-300 hover:text-white' }} flex items-center gap-2">
                <i class="fas fa-image"></i> Change Picture
            </a>
        </li>
        <li>
            <a href="{{ route('profiles.password') }}"
                class="{{ request()->routeIs('profiles.password') ? 'font-bold text-yellow-400 hover:text-yellow-500' : 'text-gray-300 hover:text-white' }} flex items-center gap-2">
                <i class="fas fa-key"></i> Change Password
            </a>
        </li>
        <li>
            <a href="{{ route('profiles.username') }}"
                class="{{ request()->routeIs('profiles.username') ? 'font-bold text-yellow-400 hover:text-yellow-500' : 'text-gray-300 hover:text-white' }} flex items-center gap-2">
                <i class="fas fa-user-edit"></i> Change Username
            </a>
        </li>
    </ul>
</div>
