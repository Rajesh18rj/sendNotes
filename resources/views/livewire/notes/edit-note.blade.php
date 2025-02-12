<?php

use App\Models\Note;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use function Livewire\Volt\layout;

//    @layout('layouts.app');

new #[Layout('layouts.app')] class extends Component {

    public Note $note;
    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteSendDate;
    public $noteIsPublished;

    public function mount(Note $note)
    {
        $this->authorize('update', $note);
        $this->fill($note);

        $this->noteTitle = $note->title;
        $this->noteBody = $note->body;
        $this->noteRecipient = $note->recipient;
        $this->noteSendDate = $note->send_date;
        $this->noteIsPublished = $note->is_published;
    }

    public function updateNote(){
        $validated = $this->validate([
            'noteTitle' => ['required', 'string', 'min:5'],
            'noteBody' => ['required', 'string', 'min:20'],
            'noteRecipient' => ['required', 'email'],
            'noteSendDate' => ['required', 'date' ],
        ]);

        $this->note->update([
            'title'=> $this->noteTitle,
            'body' => $this->noteBody,
            'recipient'=> $this->noteRecipient,
            'send_date' => $this->noteSendDate,
            'is_published' => $this->noteIsPublished,
        ]);

    }

}; ?>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <form wire:submit="updateNote" class="space-y-4">
                <x-input wire:model="noteTitle" label="Title" placeholder="It's been a great day today!" />

                <x-textarea wire:model="noteBody" label="Your Note" placeholder="Share your thoughts with your loved ones!" />

                <x-input icon='user' wire:model="noteRecipient" label="Recipient" placeholder="yourfriend@gmail.com" />

                <x-input icon='calendar' wire:model="noteSendDate" type="date" label="Send Date" />

                <x-checkbox label="Note Published" wire:model="noteIsPublished" />

                <div class="pt-4">
                    <x-button primary right-icon="calendar" spinner type="submit"> Save Note</x-button>
                    <x-button></x-button>
                </div>

                <x-errors />

            </form>
        </div>
    </div>
