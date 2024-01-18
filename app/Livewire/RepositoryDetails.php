<?php

namespace App\Livewire;

use App\Models\Repository;
use CzProject\GitPhp\Git;
use CzProject\GitPhp\GitRepository;
use Livewire\Component;

class RepositoryDetails extends Component
{
    public Repository $repository;

    public function render()
    {
        $git = new Git();

        $repo = $git->open(storage_path('repositories/' . $this->repository->title . '.git'));

        $branches = $repo->getBranches() ?? ['master'];
        $tags = $repo->getTags() ?? [];
        $commits = $repo->execute('log', '--pretty=format:"%s"');

        $tree = $repo->execute('ls-tree', "--format='%(objectmode) %(objecttype) %(objectname) %(path)", 'HEAD');
        $objects = [];

        foreach ($tree as $object) {
            $data = explode(' ', $object);

            $lastCommit = explode(
                '-separator-',
                $repo->execute(
                    'log',
                    '--find-object=' . $data[2],
                    "--pretty=format:'%ad-separator-%s'",
                    '--date=short'
                )[0]
            );

            $objects[] = [
                'type' => $data[1],
                'name' => $data[3],
                'last_commit' => [
                    'date' => $lastCommit[0],
                    'description' => $lastCommit[1]
                ]
            ];
        }

        $folders = array_filter($objects, fn ($object) => $object['type'] === 'tree');
        $files = array_filter($objects, fn ($object) => $object['type'] === 'blob');

        return view('livewire.repository-details', compact(['branches', 'tags', 'objects', 'commits', 'folders', 'files']))->extends('layouts.app');
    }
}
