<html>
<head>
    <title>Expose</title>
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="tailwind-config">
        {
          "darkMode": "class",
          "theme": {
              "extend": {
                  "colors": {
                      "dark-blue-800": "#ff9900"
                  }
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
<div class="min-h-screen bg-white">


    <nav class="border-b border-gray-200 dark:border-gray-700">
        <div class="py-4 px-4 md:px-6 flex flex-col md:flex-row md:items-center justify-between space-y-3 md:space-y-0 dark:bg-gray-900">
            <div class="flex space-x-8 items-center text-base">

                <a href="https://expose.dev" target="_blank" class="inline-flex items-center self-start"><img
                            src="https://beyondco.de/apps/icons/expose.png" alt="expose.dev" class="h-8 lg:h-10">
                    <div class="ml-4"><p class="text-lg lg:text-2xl tracking-tight font-bold">Expose</p>
                        <p class="text-xs text-gray-400">by Beyond Code</p></div>
                </a>
                <div>
                    <a href="/users"
                       class="
                           {% if request.is('users*') %} text-gray-900 {% else %} text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:text-gray-700 focus:border-gray-300{% endif %}
                           font-medium leading-5 transition duration-150 ease-in-out">
                        Users
                    </a>
                </div>
            </div>
            <div class="flex items-center">
                Servername
            </div>
        </div>
    </nav>

    <div class="mx-auto max-w-7xl grid gap-4 md:grid-cols-2 lg:grid-cols-3 mt-8">
        <div class="rounded-xl border bg-card text-card-foreground shadow">
            <div class="gap-y-1.5 p-6 flex flex-row items-center justify-between space-y-0 pb-2"><h3
                        class="tracking-tight text-sm font-medium"> Total Users </h3>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
                </svg>

            </div>
            <div class="p-6 pt-0">
                <div class="text-2xl font-bold"> $45,231.89</div>
            </div>
        </div>
        <div class="rounded-xl border bg-card text-card-foreground shadow">
            <div class="gap-y-1.5 p-6 flex flex-row items-center justify-between space-y-0 pb-2"><h3
                        class="tracking-tight text-sm font-medium"> Subscriptions </h3>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" class="h-4 w-4 text-muted-foreground">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
            </div>
            <div class="p-6 pt-0">
                <div class="text-2xl font-bold"> +2350</div>
                <p class="text-xs text-muted-foreground"> +180.1% from last month </p></div>
        </div>
        <div class="rounded-xl border bg-card text-card-foreground shadow">
            <div class="gap-y-1.5 p-6 flex flex-row items-center justify-between space-y-0 pb-2"><h3
                        class="tracking-tight text-sm font-medium"> Sales </h3>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" class="h-4 w-4 text-muted-foreground">
                    <rect width="20" height="14" x="2" y="5" rx="2"></rect>
                    <path d="M2 10h20"></path>
                </svg>
            </div>
            <div class="p-6 pt-0">
                <div class="text-2xl font-bold"> +12,234</div>
                <p class="text-xs text-muted-foreground"> +19% from last month </p></div>
        </div>
    </div>

    <div class="py-10">
        <header>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold leading-tight text-gray-900">
                    @yield('title')
                </h1>
            </div>
        </header>
        <main>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" id="app">
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

        mounted() {
            this.getUsers();
            this.getConnections();
            this.getSites();
        }
    })
</script>
</body>
</html>
