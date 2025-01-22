@extends('server.layouts.app')
@section('title')
    Users
@endsection

@section('content')
    <div class="flex flex-col py-8">
        <form class="max-w-md p-4 rounded-2xl bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-white/10 text-gray-500 dark:text-gray-300 shadow-sm !pt-2 px-2">
            <div class="flex items-center justify-between w-full">
                <h2 class="font-medium text-gray-800 dark:text-white text-base font-headline mb-4 mb-0 pl-2 mt-2 ">
                    Add new user
                </h2>
            </div>
            <div class="pl-2 pt-0 space-y-4">
                <div>
                    <label for="username"
                           class="font-medium text-gray-800 dark:text-gray-100 text-sm font-medium dark:text-gray-100 mb-1">
                        Username
                    </label>
                    <div class="">
                        <input id="username"
                               type="text"
                               v-model="userForm.name"
                               class="w-full border rounded-lg block disabled:shadow-none dark:shadow-none appearance-none text-base sm:text-sm py-2 h-10 leading-[1.375rem] pl-3 pr-3 bg-white dark:bg-white/10 dark:disabled:bg-white/[7%] text-gray-700 disabled:text-gray-500 placeholder-gray-400 disabled:placeholder-gray-400/70 dark:text-gray-300 dark:disabled:text-gray-400 dark:placeholder-gray-400 dark:disabled:placeholder-gray-500 shadow-sm border-gray-200 border-b-gray-300/80 disabled:border-b-gray-200 dark:border-white/10 dark:disabled:border-white/5"/>

                    </div>
                </div>

                <div>
                    <label for="token"
                           class="font-medium text-gray-800 dark:text-gray-100 text-sm font-medium dark:text-gray-100 mb-1">
                        Token
                    </label>
                    <div class="">
                        <input id="token"
                               type="text"
                               v-model="userForm.token"
                               class="w-full border rounded-lg block disabled:shadow-none dark:shadow-none appearance-none text-base sm:text-sm py-2 h-10 leading-[1.375rem] pl-3 pr-3 bg-white dark:bg-white/10 dark:disabled:bg-white/[7%] text-gray-700 disabled:text-gray-500 placeholder-gray-400 disabled:placeholder-gray-400/70 dark:text-gray-300 dark:disabled:text-gray-400 dark:placeholder-gray-400 dark:disabled:placeholder-gray-500 shadow-sm border-gray-200 border-b-gray-300/80 disabled:border-b-gray-200 dark:border-white/10 dark:disabled:border-white/5"/>

                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div>
                        <label for="can_specify_subdomains"
                               class="font-medium text-gray-800 dark:text-gray-100 text-sm font-medium dark:text-gray-100 mb-1">
                            Can specify custom subdomains
                        </label>
                        <div class="mt-1">
                            <div class="inline-flex items-center">
                                <label class="flex items-center cursor-pointer relative">
                                    <input id="can_specify_subdomains"
                                           v-model="userForm.can_specify_subdomains"
                                           name="can_specify_subdomains"
                                           value="1"
                                           type="checkbox"
                                           class="peer h-5 w-5 cursor-pointer transition-all appearance-none rounded border bg-white shadow-sm border-gray-200 checked:border-transparent dark:border-gray-700 checked:bg-primary"
                                    />
                                    <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 pointer-events-none">
                                                    @include('icons.checkmark')
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>


                <div>
                    <label for="max_connections"
                           class="font-medium text-gray-800 dark:text-gray-100 text-sm font-medium dark:text-gray-100 mb-1">
                        Maximum Open Connections
                    </label>
                    <div class="">
                        <input id="max_connections"
                               type="text"
                               v-model="userForm.max_connections"
                               class="w-full border rounded-lg block disabled:shadow-none dark:shadow-none appearance-none text-base sm:text-sm py-2 h-10 leading-[1.375rem] pl-3 pr-3 bg-white dark:bg-white/10 dark:disabled:bg-white/[7%] text-gray-700 disabled:text-gray-500 placeholder-gray-400 disabled:placeholder-gray-400/70 dark:text-gray-300 dark:disabled:text-gray-400 dark:placeholder-gray-400 dark:disabled:placeholder-gray-500 shadow-sm border-gray-200 border-b-gray-300/80 disabled:border-b-gray-200 dark:border-white/10 dark:disabled:border-white/5"/>

                    </div>
                </div>
            </div>
            <div class="flex justify-end mt-4 -mb-2">
                <button type="submit"
                        @click.prevent="saveUser"
                        class=" items-center font-medium justify-center gap-2 whitespace-nowrap group disabled:opacity-75 dark:disabled:opacity-75 disabled:cursor-default disabled:pointer-events-none h-10 text-sm rounded-lg px-4 inline-flex  primary-button font-medium bg-primary text-white dark:shadow-none *:transition-opacity">
                    Save
                </button>
            </div>
        </form>

        <div class="p-4 rounded-2xl bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-white/10 text-gray-500 dark:text-gray-300 shadow-sm !pt-2 px-2">
            <div class="flex items-center justify-between w-full pb-2">
                <h2 class="font-medium text-gray-800 dark:text-white text-base font-headline mb-4 mb-0 pl-2 !mb-0">
                    List
                </h2>


                <div class="w-full max-w-sm">
                    <input id="search"
                           type="text"
                           v-model="search"
                           autocomplete="off"
                           placeholder="Search users"
                           class="flex w-full max-w-sm rounded-md bg-white dark:bg-white/10 border border-gray-800/15 px-2 py-2 shadow-sm text-sm text-gray-800 dark:text-gray-200 ring-offset-background placeholder:text-gray-400 placeholder:font-medium focus-visible:outline-none focus-visible:border-gray-800/30 dark:focus-visible:border-gray-700 disabled:cursor-not-allowed disabled:opacity-50"/>
                </div>
            </div>

            <div class="rounded-lg bg-white dark:bg-gray-800/50 border border-gray-200 dark:border-white/10 shadow-md !-mb-2">
                <div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full table-fixed divide-y divide-gray-200 dark:divide-white/20 text-gray-800 whitespace-nowrap whitespace-normal ">
                            <thead>
                            <tr>
                                <th class="p-4 text-left text-sm font-medium text-gray-500 dark:text-white">
                                    Name
                                </th>
                                <th class="p-4 text-left text-sm font-medium text-gray-500 dark:text-white">
                                    Auth Token
                                </th>
                                <th class="p-4 text-sm font-medium text-gray-500 dark:text-white text-right">
                                    Max Connections
                                </th>
                                <th class="p-4 text-sm font-medium text-gray-500 dark:text-white text-right">
                                    Subdomains
                                </th>
                                <th class="p-4 text-sm font-medium text-gray-500 dark:text-white text-right">
                                    Created At
                                </th>
                                <th class="py-4 px-6 text-left text-sm font-medium text-gray-500 dark:text-white">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 dark:divide-white/20 text-sm">
                            <tr v-if="users.length > 0" v-for="user in users"
                                class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                <td class="px-4 py-3  text-gray-800 dark:text-gray-300">
                                    @{ user.name }
                                </td>
                                <td class="px-4 py-3 font-mono text-gray-800 dark:text-gray-300">
                                    @{ user.auth_token }
                                </td>
                                <td class="px-4 py-3 text-gray-800 dark:text-gray-300 text-right">
                                    @{ user.max_connections }
                                </td>
                                <td class="px-4 py-3 text-gray-400 dark:text-gray-300">
                                    <div class="flex justify-end">
                                        <span v-if="user.can_specify_subdomains === 0">
                                            @include('icons.micro-x-circle')
                                        </span>
                                        <span v-else>
                                            @include('icons.micro-check-circle')
                                        </span>
                                    </div>
                                </td>
                                <td class="px-4 py-3  text-gray-800 dark:text-gray-300 text-right">
                                    @{ user.created_at }
                                </td>

                                <td class="px-4 py-3 text-right text-gray-800 dark:text-gray-300">
                                    <button @click.prevent="deleteUser(user)" type="button"
                                            title="Delete user"
                                            class="relative items-center font-medium justify-center gap-2 whitespace-nowrap group disabled:opacity-75 dark:disabled:opacity-75 disabled:cursor-default disabled:pointer-events-none h-10 text-sm rounded-lg w-10 inline-flex  bg-transparent hover:bg-gray-200 dark:hover:bg-white/15 text-red-600 hover:text-red-600 dark:text-white">
                                        @include('icons.micro-trash')
                                    </button>
                                </td>
                            </tr>


                            <tr v-if="users.length <= 0 && search === ''"
                                class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                <td class="px-4 py-3 text-xs text-center text-gray-700 dark:text-gray-300" colspan="6">
                                    There are no users on this server.
                                </td>
                            </tr>

                            <tr v-if="users.length <= 0 && search !== ''"
                                class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                <td class="px-4 py-3 text-xs text-center text-gray-700 dark:text-gray-300" colspan="6">
                                    Your search did not return any results.
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end space-x-2 text-gray-900 dark:text-gray-200 mt-6 -mb-2"
                 v-if="paginated.current_page > 0">
                <button
                        :disabled="paginated.previous_page == null"
                        v-on:click="getUsers(paginated.previous_page)"
                        type="button"
                        class="relative items-center font-medium justify-center gap-2 whitespace-nowrap group disabled:opacity-75 dark:disabled:opacity-75 disabled:cursor-default disabled:pointer-events-none h-10 text-sm rounded-lg px-4 inline-flex bg-white hover:bg-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700/50 text-gray-500 dark:text-gray-200 border border-gray-200 hover:border-gray-200 border-b-gray-300/80 dark:border-gray-700 dark:hover:border-gray-700 shadow-sm"
                >
                    Previous
                </button>

                <button
                        :disabled="paginated.next_page == null"
                        v-on:click="getUsers(paginated.next_page)"
                        type="button"
                        class="relative items-center font-medium justify-center gap-2 whitespace-nowrap group disabled:opacity-75 dark:disabled:opacity-75 disabled:cursor-default disabled:pointer-events-none h-10 text-sm rounded-lg px-4 inline-flex bg-white hover:bg-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700/50 text-gray-500 dark:text-gray-200 border border-gray-200 hover:border-gray-200 border-b-gray-300/80 dark:border-gray-700 dark:hover:border-gray-700 shadow-sm"
                >
                    Next
                </button>
            </div>

        </div>
        @endsection
        @section('scripts')
            <script>
                new Vue({
                    el: '#app',

                    delimiters: ['@{', '}'],

                    data: {
                        search: '',
                        userForm: {
                            name: '',
                            token: '',
                            can_specify_subdomains: true,
                            max_connections: 0,
                            errors: {},
                        },
                        paginated: {!! json_encode($paginated) !!}
                    },

                    computed: {
                        total: function () {
                            return this.paginated.total;
                        },
                        users: function () {
                            return this.paginated.users;
                        }
                    },

                    watch: {
                        search(val) {
                            if (val.length < 3) {
                                if (val.length === 0) {
                                    this.getUsers(1);
                                }
                                return;
                            }
                            this.getUsers(1);
                        }
                    },

                    methods: {
                        getUsers(page) {
                            fetch('/api/users?search=' + this.search + '&page=' + page)
                                .then((response) => {
                                    return response.json();
                                }).then((data) => {
                                this.paginated = data.paginated;
                            });
                        },

                        deleteUser(user) {
                            fetch('/api/users/' + user.id, {
                                method: 'DELETE',
                            }).then((response) => {
                                return response.json();
                            }).then((data) => {
                                this.getUsers(1)
                            });
                        },
                        saveUser() {
                            fetch('/api/users', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify(this.userForm)
                            }).then((response) => {
                                return response.json();
                            }).then((data) => {
                                if (data.user) {
                                    this.userForm.name = '';
                                    this.userForm.token = '';
                                    this.userForm.can_specify_subdomains = true;
                                    this.userForm.max_connections = 0;
                                    this.userForm.errors = {};
                                    this.users.unshift(data.user);
                                }
                                if (data.errors) {
                                    this.userForm.errors = data.errors;
                                }
                            });
                        }
                    }
                })
            </script>
    </div>
@endsection
