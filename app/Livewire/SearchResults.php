<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Reactive;

class SearchResults extends Component
{
    #[Reactive]
    public $results = [];

    #[Reactive]
    public $searchText = '';

    #[Reactive]
    public $categories = [];

    public function render()
    {
        return view('livewire.search-results');
    }
}