<div>
    <h3 class="text-2xl text-0d171a font-semibold">{{ __('Notifiche email') }}</h3>
    <div class="space-y-3 mt-6">
        <dl>
            <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">{{ __('Domande dei clienti') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    <button
                        x-data="{ accepted: @entangle('customer_questions_notifications')}"
                        x-on:click="$wire.updateNotification('customer_questions_notifications')"
                        type="button"
                        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-627277/30 focus:ring-offset-2"
                        :class="{ 'bg-67b26a' : accepted, 'bg-ff7968': !accepted }"
                        role="switch"
                        :aria-checked="accepted">
                        <div
                            class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                            :class="{ 'translate-x-5': accepted, 'translate-x-0': !accepted}"
                        ></div>
                    </button>
                </dd>
            </div>
            <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">{{ __('Prenotazioni') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    <button
                        x-data="{ accepted: @entangle('bookings_notifications')}"
                        x-on:click="$wire.updateNotification('bookings_notifications')"
                        type="button"
                        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-627277/30 focus:ring-offset-2"
                        :class="{ 'bg-67b26a' : accepted, 'bg-ff7968': !accepted }"
                        role="switch"
                        :aria-checked="accepted">
                        <div
                            class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                            :class="{ 'translate-x-5': accepted, 'translate-x-0': !accepted}"
                        ></div>
                    </button>
                </dd>
            </div>
            <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">{{ __('Contabilità') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    <button
                        x-data="{ accepted: @entangle('accountings_notifications')}"
                        x-on:click="$wire.updateNotification('accountings_notifications')"
                        type="button"
                        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-627277/30 focus:ring-offset-2"
                        :class="{ 'bg-67b26a' : accepted, 'bg-ff7968': !accepted }"
                        role="switch"
                        :aria-checked="accepted">
                        <div
                            class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                            :class="{ 'translate-x-5': accepted, 'translate-x-0': !accepted}"
                        ></div>
                    </button>
                </dd>
            </div>
            <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">{{ __('Recensioni') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    <button
                        x-data="{ accepted: @entangle('reviews_notifications')}"
                        x-on:click="$wire.updateNotification('reviews_notifications')"
                        type="button"
                        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-627277/30 focus:ring-offset-2"
                        :class="{ 'bg-67b26a' : accepted, 'bg-ff7968': !accepted }"
                        role="switch"
                        :aria-checked="accepted">
                        <div
                            class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                            :class="{ 'translate-x-5': accepted, 'translate-x-0': !accepted}"
                        ></div>
                    </button>
                </dd>
            </div>
        </dl>
    </div>
</div>
