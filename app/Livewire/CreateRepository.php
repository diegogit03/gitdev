<?php

namespace App\Livewire;

use App\Models\Repository;
use CzProject\GitPhp\Git;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateRepository extends Component
{
    #[Validate('required')]
    public $title = '';

    public function render()
    {
        return view('livewire.create-repository')->extends('layouts.app');
    }

    public function create()
    {
        $this->validate();

        $repository = new Repository();
        $repository->title = $this->title;
        $repository->user_id = Auth::id();
        $repository->save();

        $git = new Git();

        $git->init(storage_path('repositories/' . $this->title));

        $this->redirect(route('home'), navigate: true);
    }
}
