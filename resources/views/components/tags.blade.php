<div x-data="{
        value: '',
        options: @entangle($attributes->wire('model')),
        addItem() {
            this.options.push(this.value[0].toUpperCase() + this.value.substring(1));
            this.value = '';
        },
        deleteItem(index) {
            this.options = this.options.filter((item, i) => {
                return index !== i
            })
        }
    }">
    <input class="h-14 block w-full text-sm text-0d171a border border-e2eaeb rounded focus:outline-none focus:ring-0 focus:ring-offset-0 placeholder:placeholder-e2eaeb disabled:opacity-50 disabled:cursor-not-allowed" x-model="value" x-on:keydown.enter="addItem" />
    @error($attributes->wire('model')->value())
        <x-input-error :for="$attributes->wire('model')->value()">{{ $message }}</x-input-error>
    @enderror
    <div class="mt-2 flex items-center">
        <template x-for="(option, index) in options">
            <div
                class="inline-flex items-center gap-x-0.5 rounded-full bg-white mx-1 px-2.5 py-1 text-xs font-medium text-03b8ce ring-1 ring-inset ring-03b8ce first:ml-0 last:mr-0"
            >
                <span x-text="option"></span>
                <button x-on:click="deleteItem(index)" type="button" class="group relative -mr-1 h-3.5 w-3.5 rounded-sm">
                    <svg viewBox="0 0 14 14" class="h-3.5 w-3.5 stroke-03b8ce/50 group-hover:stroke-03b8ce/75">
                        <path d="M4 4l6 6m0-6l-6 6"/>
                    </svg>
                    <span class="absolute -inset-1"></span>
                </button>
            </div>
        </template>
    </div>
</div>
