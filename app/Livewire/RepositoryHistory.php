<?php

namespace App\Livewire;

use App\Models\Repository;
use CzProject\GitPhp\Git;
use Livewire\Component;

class RepositoryHistory extends Component
{
    public Repository $repository;

    public function render()
    {
        $git = new Git();

        $repo = $git->open(storage_path('repositories/' . $this->repository->title . '.git'));

        $commits = array_map(
            fn ($commit) => explode('-separator-', $commit),
            $repo->execute(
                'log',
                "--pretty=format:'%ad-separator-%s-separator-%aN'",
                '--date=short'
            )
        );

        $timeline = [];

        for ($i=0; $i < count($commits); $i++) {
            $commit = $commits[$i];
            $commitDate = $commit[0];

            $commitList = [];

            $commitList[] = [
                'description' => $commit[1],
                'author' => $commit[2]
            ];

            $j = $i + 1;
            while ($j < count($commits)) {
                $childCommit = $commits[$j];

                if ($childCommit[0] !== $commitDate) break;

                $commitList[] = [
                    'description' => $childCommit[1],
                    'author' => $childCommit[2]
                ];
                $j++;
                $i++;
            }

            $timeline[] = [
                'date' => $commitDate,
                'commits' => $commitList
            ];
        }

        // $commits = array_map(fn ($hash) => $repo->getCommit($hash), $hashes);

        // dd($timeline);

        return view('livewire.repository-history', compact('timeline'))->extends('layouts.app');
    }
}
