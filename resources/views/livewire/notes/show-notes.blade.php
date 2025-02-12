<?php

use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {

    public function delete($noteId)
    {
        $note = Note::where('id', $noteId)->first();
        $this->authorize('delete',$note);
        $note->delete();
    }

    public function with(): array
    {
        return [
            'notes' => Auth::user()
                ->notes()
                ->orderBy('send_date', 'asc')
                ->get(),
        ];
    }

}; ?>

<div>
    <div class="space-y-2">
        @if($notes->isEmpty())
            <div class="text-center">
                <p class="text-xl font-bold">No notes yet..</p>
                <p class="text-sm">Lets create your first note to send</p>

                <x-button href="{{ route('notes.create') }}" primary icon-right="plus" class="mt-6" wire:navigate>Create
                    Notes
                </x-button>
            </div>

        @else

            <x-button href="{{ route('notes.create') }}" primary icon-right="plus" class="mt-6 mb-12" wire:navigate>
                Create Notes
            </x-button>

            <div class="grid grid-cols-3 gap-4 ">
                @foreach ($notes as $note)
                    <x-card wire:key="{{ $note->id }}">
                        <div class="flex justify-between">
                            <div>
                                <a  href="{{ route('edit-note', ['note' => $note->id]) }}" wire:navigate
                                   class="text-xl font-bold hover:underline dark:hover:text-blue-500">
                                    {{ $note->title }}
                                </a>
                                <p class="text-xs mt-2">{{ Str::limit($note->body, 50) }}</p>
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ \Carbon\Carbon::parse($note->send_date)->format('M-d-Y') }}
                            </div>
                        </div>
                        <div class="flex items-end justify-between mt-4 space-x-1">
                            <p class="text-xs">Recipient: <span class="font-semibold"> {{ $note->recipient }}</span></p>
                            <div>
                                <x-button info icon="eye"></x-button>
                                <x-button wire:click="delete('{{ $note->id }}')" icon="trash"></x-button>
                            </div>
                        </div>
                    </x-card>
                @endforeach
            </div>
        @endif
    </div>
</div>
