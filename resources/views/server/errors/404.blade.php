<html>
<head>
    <title>Expose</title>
    <meta charset="UTF-8">
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
</head>
<body>
<div class="relative min-h-screen bg-white dark:bg-gray-800">
    <div id="stats">
        <nav>
            <div class="max-w-7xl mx-auto py-4 px-4 md:px-6 flex flex-col md:flex-row md:items-center justify-between">
                <div class="flex space-x-8 items-center text-base">
                    <a href="https://expose.dev" class="inline-flex items-center self-start border-0">
                        <img src="https://beyondco.de/apps/icons/expose.png" alt="expose.dev" class="h-8 lg:h-10">
                        <div class="ml-4"><p class="text-lg lg:text-3xl tracking-tight text-gray-900 font-bold dark:text-white">
                                Expose</p>
                            <p class="text-xs text-gray-400">by Beyond Code</p></div>
                    </a>
                </div>
            </div>
        </nav>
        <div class="max-w-xl mx-auto rounded-md  mt-32 px-4 py-12 mb-16">
            <h1 class="text-6xl font-extrabold text-center">404</h1>
            <p class="px-4 py-2 rounded mx-auto mt-8 text-lg text-center font-medium">
                The tunnel »{{ $subdomain }}« was not found on this Expose server.
            </p>
        </div>
        <div class="grid grid-cols-2 gap-x-8 max-w-2xl mx-auto rounded-md bg-gray-50 dark:bg-gray-900/50 text-gray-700 dark:text-gray-200 shadow mt-32 p-12 mb-16">


            <div class="col-span-2 pb-8">

                <p>
                    Expose allows others to access web services on your local machine through
                    any firewall or VPN. Secure and without cumbersome network configuration.
                </p>
                <p class="font-bold my-4">Simple, secure <span class="text-primary">and open source.</span></p>
                <p>
                    The Expose platform at <a href="https://expose.dev">expose.dev</a> is the managed Expose service and
                    gives you a hassle-free
                    experience when sharing your local development environment. We take care of TLS/SSL certificates for
                    your tunnels, manage access of your team, and run a global network of Expose servers for fast
                    connections.
                </p>


                <div class="flex justify-center mt-4 mb-8">
                    <a class="bg-primary-700 hover:bg-[#EC5C86] h-10 mx-4 text-white rounded-[8px] border border-[#CA3A64] inline-flex relative bg-primary text-white"
                       href="https://expose.dev">
                        <div class="rounded-[8px] border-[#FFFFFF40] border-t h-full w-full flex items-center px-6">
                            Learn more
                        </div>
                    </a>
                </div>
            </div>


            <div class="">
                <h3 class="font-medium">Are you the developer of this site?</h3>

                <p>
                    Check out the <a href="https://expose.dev/docs">documentation</a> of Expose to find out more about this error.
                </p>
            </div>

            <div class="">
                <h3 class="font-medium">Just visiting?</h3>

                <p>
                    Wait a moment and try again. The developer might be working on the site right now.
                </p>
            </div>

        </div>
    </div>
</div>

<style>
    a {
        border-bottom-width: 1px;
        color: rgb(221 74 122);
        text-decoration-line: none
    }

</style>
</body>
</html>

