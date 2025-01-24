<script>
    Vue.component('modal', {
        template: `
        <transition
                enter-active-class="ease-out duration-300"
                enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                enter-to-class="opacity-100 translate-y-0 sm:scale-100"
                leave-active-class="ease-in duration-200"
                leave-from-class="opacity-100 translate-y-0 sm:scale-100"
                leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        >
            <div v-show="visible"
                 class="fixed inset-0 bg-gray-500/50">
                <div class="fixed z-0 inset-0 w-screen overflow-y-auto">
                    <div class="flex z-0 min-h-full items-end justify-center p-4  sm:items-center sm:p-0">
                        <div class="w-full max-w-md border border-black/5 bg-[#F5F5F580] dark:bg-gray-800/50 rounded-3xl p-2 backdrop-blur">
                            <div class="p-6 bg-white dark:bg-zinc-800 border rounded-2xl shadow-lg border-transparent dark:border-zinc-700">
                              <slot></slot>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
        `,

        data() {
            return {
                visible: false,
            }
        },
        methods: {
            show() {
                this.visible = true;
            },
            close() {
                this.visible = false
            }
        },
    });
</script>

