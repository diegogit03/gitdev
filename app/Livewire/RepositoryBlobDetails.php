<?php

namespace App\Livewire;

use App\Models\Repository;
use Livewire\Component;

class RepositoryBlobDetails extends Component
{
    public Repository $repository;
    public string $blobName;

    public function render()
    {
        $repositoryPath = storage_path('repositories/' . $this->repository->title . '.git');

        $gitCommand = 'git show HEAD:' . $this->blobName;
        $blobContent = shell_exec("cd $repositoryPath && $gitCommand");

        return view('livewire.repository-blob-details', compact('blobContent'))->extends('layouts.app');
    }
}
