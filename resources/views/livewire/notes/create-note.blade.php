<?php

use Livewire\Volt\Component;

new class extends Component {
    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteSendDate;

    public function submit(){
        $validated = $this->validate([
            'noteTitle' => ['required', 'string', 'min:5'],
            'noteBody' => ['required', 'string', 'min:20'],
            'noteRecipient' => ['required', 'email'],
            'noteSendDate' => ['required', 'date', ],
        ]);

        auth()->user()->notes()->create([
            'title'=> $this->noteTitle,
            'body' => $this->noteBody,
            'recipient'=> $this->noteRecipient,
            'send_date' => $this->noteSendDate,
            'is_published' => true,
        ]);

        redirect(route('notes.index'));
    }
}; ?>

<div>
    <form wire:submit="submit" class="space-y-4">
        <x-input wire:model="noteTitle" label="Title" placeholder="It's been a great day today!" />

        <x-textarea wire:model="noteBody" label="Your Note" placeholder="Share your thoughts with your loved ones!" />

        <x-input icon='user' wire:model="noteRecipient" label="Recipient" placeholder="yourfriend@gmail.com" />

        <x-input icon='calendar' wire:model="noteSendDate" type="date" label="Send Date" />

        <div class="pt-4">
            <x-button primary right-icon="calendar" spinner wire:click="submit">Schedule Note</x-button>
        </div>

        <x-errors />

    </form>
</div>
