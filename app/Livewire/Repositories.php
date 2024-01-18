<?php

namespace App\Livewire;

use App\Models\Repository;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Repositories extends Component
{
    public function render()
    {
        return view('livewire.repositories')->extends('layouts.app');
    }

    #[Computed()]
    public function repositories()
    {
        return Repository::all();
    }

    public function create()
    {
        return $this->redirect(route('repositories.create'), navigate: true);
    }
}
