<html>
<head>
    <title>Expose</title>
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#DE4E78',
                        gray: {
                            50: '#fafafa',
                            100: '#f4f4f5',
                            200: '#e4e4e7',
                            300: '#d4d4d8',
                            400: '#a1a1aa',
                            500: '#71717a',
                            600: '#52525b',
                            700: '#3f3f46',
                            800: '#27272a',
                            900: '#18181b',
                            950: '#09090b',
                        }
                    },
                }
            }
        }
    </script>
    <style type="postcss">
        ::selection {
            @apply bg-pink-500 bg-opacity-50;
        }
    </style>
</head>
<body>
<div class="min-h-screen bg-white dark:bg-gray-800">
    <div id="stats">
        <nav>
            <div class="max-w-7xl mx-auto py-4 px-4 md:px-6 flex flex-col md:flex-row md:items-center justify-between space-y-3 md:space-y-0">
                <div class="flex space-x-8 items-center text-base">

                    <a href="https://expose.dev" target="_blank" class="inline-flex items-center self-start"><img
                                src="https://beyondco.de/apps/icons/expose.png" alt="expose.dev" class="h-8 lg:h-10">
                        <div class="ml-4"><p class="text-lg lg:text-2xl tracking-tight font-bold dark:text-white">
                                Expose</p>
                            <p class="text-xs text-gray-400">by Beyond Code</p></div>
                    </a>

                </div>
                <div class="flex space-x-4 items-center">
                    <a href="/users"
                       class="leading-5 transition duration-150 ease-in-out"
                       v-bind:class="{ 'text-primary font-bold': currentRequest === 'users', 'text-gray-800 dark:text-gray-200 dark:hover:text-gray-100 font-medium ': currentRequest !== 'users' }">
                        Users
                    </a>

                    <a href="/sites"
                       class="leading-5 transition duration-150 ease-in-out"
                       v-bind:class="{ 'text-primary font-bold': currentRequest === 'sites', 'text-gray-800 dark:text-gray-200 dark:hover:text-gray-100 font-medium ': currentRequest !== 'sites' }">
                        Sites
                    </a>

                    <a href="/tcp"
                       class="leading-5 transition duration-150 ease-in-out"
                       v-bind:class="{ 'text-primary font-bold': currentRequest === 'tcp', 'text-gray-800 dark:text-gray-200 dark:hover:text-gray-100 font-medium ': currentRequest !== 'tcp' }">
                        TCP Connections
                    </a>

                    <a href="/settings"
                       class="leading-5 transition duration-150 ease-in-out"
                       v-bind:class="{ 'text-primary font-bold': currentRequest === 'settings', 'text-gray-800 dark:text-gray-200 dark:hover:text-gray-100 font-medium ': currentRequest !== 'settings' }">
                        Settings
                    </a>
                </div>

                <div class="flex items-center text-xl font-bold text-gray-600">
                    EU-1
                </div>
            </div>
        </nav>

        <div class="border-b border-gray-200 dark:border-gray-700"></div>

        <div class="max-w-7xl mx-auto  grid gap-4 md:grid-cols-2 lg:grid-cols-3 py-12 px-8">
            <div class="rounded-md bg-gray-50 dark:bg-gray-900/50 text-gray-700 dark:text-gray-200 shadow">
                <div class="gap-y-1.5 p-6 flex flex-row items-center justify-between space-y-0 pb-2">
                    <h3 class="tracking-tight text-sm font-medium"> Total Users </h3>

                    @include('icons.users')

                </div>
                <div class="p-6 pt-0">
                    <div class="text-2xl text-gray-800 dark:text-gray-100 font-bold">
                        @{ users.total }
                    </div>
                </div>
            </div>
            <div class="rounded-md bg-gray-50 dark:bg-gray-900/50 text-gray-700 dark:text-gray-200 shadow">
                <div class="gap-y-1.5 p-6 flex flex-row items-center justify-between space-y-0 pb-2">
                    <h3 class="tracking-tight text-sm font-medium"> Shared Sites </h3>
                    @include('icons.computer-desktop')
                </div>
                <div class="p-6 pt-0">
                    <div class="text-2xl text-gray-800 dark:text-gray-100 font-bold">
                        @{ sites.length }
                    </div>
                </div>
            </div>
            <div class="rounded-md bg-gray-50 dark:bg-gray-900/50 text-gray-700 dark:text-gray-200 shadow">
                <div class="gap-y-1.5 p-6 flex flex-row items-center justify-between space-y-0 pb-2">
                    <h3 class="tracking-tight text-sm font-medium"> Shared TCP Connections </h3>
                    @include('icons.command-line')
                </div>
                <div class="p-6 pt-0">
                    <div class="text-2xl text-gray-800 dark:text-gray-100 font-bold">
                        @{ tcp_connections.length }
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="py-10">
        <header>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold leading-tight text-gray-900 dark:text-gray-200">
                    @yield('title')
                </h1>
            </div>
        </header>
        <main>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-gray-700 dark:text-gray-100" id="app">
                @yield('content')
            </div>
        </main>
    </div>
</div>


@yield('scripts')
<script>
    new Vue({
        el: '#stats',

        delimiters: ['@{', '}'],

        data: {
            users: [],
            sites: [],
            tcp_connections: [],
        },

        methods: {
            getDashboardStats() {
                // TODO: fetch user/sites stats and server name
            },
            getUsers(page) {
                fetch('/api/users')
                    .then((response) => {
                        return response.json();
                    }).then((data) => {
                    this.users = data.paginated;
                });
            },

            getConnections() {
                fetch('/api/tcp')
                    .then((response) => {
                        return response.json();
                    }).then((data) => {
                    this.tcp_connections = data.tcp_connections;
                });
            },

            getSites() {
                fetch('/api/sites')
                    .then((response) => {
                        return response.json();
                    }).then((data) => {
                    this.sites = data.sites;
                });
            },
        },

        computed: {
            currentRequest() {
                const path = window.location.pathname;
                return path.substring(path.lastIndexOf('/') + 1);
            }
        },

        mounted() {
            this.getUsers();
            this.getConnections();
            this.getSites();
        }
    })
</script>
</body>
</html>
