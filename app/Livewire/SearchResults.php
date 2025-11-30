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
    
    public $categories = [];

    public $isDropdownPage = false;

public function mount()
{
    $this->isDropdownPage = !request()->routeIs('categories.index');
}


    public function render()
    {
        return view('livewire.search-results');
    }
}