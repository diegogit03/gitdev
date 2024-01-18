<?php

namespace App\Livewire;

use App\Models\Repository;
use CzProject\GitPhp\Git;
use CzProject\GitPhp\GitRepository;
use Illuminate\Support\Facades\Process;
use Livewire\Component;

class RepositoryDetails extends Component
{
    public Repository $repository;
    public $tree;

    private function getObjects (GitRepository $repo) {
        $tree = $repo->execute(
            'ls-tree', "--format='%(objectmode) %(objecttype) %(objectname) %(path)",
            'HEAD',
            $this->tree ? $this->tree . '/' : '.'
        );

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
                'full_name' => $data[3],
                'name' => str_replace($this->tree . '/', '', $data[3]),
                'last_commit' => [
                    'date' => $lastCommit[0],
                    'description' => $lastCommit[1]
                ]
            ];
        }

        return $objects;
    }

    public function render()
    {
        $git = new Git();
        $repositoryPath = storage_path('repositories/' . $this->repository->title . '.git');

        $repo = $git->open($repositoryPath);

        $branches = $repo->getBranches() ?? ['master'];
        $tags = $repo->getTags() ?? [];
        $commits =  $repo->execute('log', '--pretty=format:"%s"');

        $gitCommand = 'git show HEAD:readme.md';
        $readmeMarkdown = shell_exec("cd $repositoryPath && $gitCommand");
        // dd($readmeMarkdown);

        $objects = $this->getObjects($repo);

        $folders = array_filter($objects, fn ($object) => $object['type'] === 'tree');
        $files = array_filter($objects, fn ($object) => $object['type'] === 'blob');

        return view('livewire.repository-details', compact([
            'branches',
            'tags',
            'objects',
            'commits',
            'folders',
            'files',
            'readmeMarkdown',
        ]))->extends('layouts.app');
    }
}
