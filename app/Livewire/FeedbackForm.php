<?php

namespace App\Livewire;

use App\Models\Feedback;
use Livewire\Component;

class FeedbackForm extends Component
{
    public $rating = 0;
    public $message = '';
    public $showForm = false;
    public $submitted = false;

    protected $rules = [
        'rating' => 'required|integer|between:1,5',
        'message' => 'nullable|string|max:500',
    ];

    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
        if ($this->showForm) {
            $this->submitted = false;
        }
    }

    public function submit()
    {
        $this->validate();

        Feedback::create([
            // 'user_id' => auth()->id(),
            'rating' => $this->rating,
            'message' => $this->message,
        ]);

        $this->submitted = true;
        $this->reset(['rating', 'message']);
    }

    public function render()
    {
        return view('livewire.feedback-form');
    }
}
