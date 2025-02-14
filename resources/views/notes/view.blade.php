<x-guest-layout>
    <div class="flex justify-between">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">{{ $note->title }}</h2>
    </div>
    <p class="mt-4 mb-12">{{ Str::limit($note->body) }}</p>
    <div class="flex items-center justify-end mt-12 space-x-2">
        <h3 class="mr-2 text-sm">Send from {{ $user->name }}</h3>
        <livewire:heartreact :note="$note" class="" />
    </div>
</x-guest-layout>
