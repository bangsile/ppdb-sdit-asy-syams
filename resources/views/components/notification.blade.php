@props(['class' => ''])
<div x-data="{ visible: false, type: '', message: '', icon: '', notifClass: '' }"
    x-on:show-notification.window="
        type = $event.detail.type;
        message = $event.detail.message;

        switch (type) {
            case 'success':
                icon = 'check-circle';
                notifClass = 'flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-zinc-900 dark:text-green-400 dark:border-green-800';
                break;

            case 'danger':
                icon = 'x-circle';
                notifClass = 'flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-zinc-900 dark:text-red-400 dark:border-red-800';
                break;

            case 'warning':
                icon = 'exclamation-circle';
                notifClass = 'flex items-center p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-zinc-900 dark:text-yellow-400 dark:border-yellow-800';
                break;

            case 'secondary':
            default:
                icon = 'information-circle';
                notifClass = 'flex items-center p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-zinc-900 dark:text-blue-400 dark:border-blue-800';
                break;
        }

        visible = true;
        setTimeout(() => { visible = false }, 3000);
    "
    x-show.transition.out.opacity.duration.1500ms="visible" x-transition:leave.opacity.duration.1500ms x-collapse
    style="display: none" class="{{ $class }}">
    <div :x-show="visible" x-transition class="text-sm">
        <div id="alert-1" :class="notifClass" role="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium">
                <span x-text="message"></span>
            </div>
        </div>
    </div>
</div>