<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Validate;

class Search extends Component
{

    #[Validate('required')]
    public $searchText = '';
    public $results = [];

    public function updatedSearchText($value) {
        $this->reset('results');

        $this->validate();

        $searchTerm = "%{$value}%";

        $this->results = Category::where('name', 'LIKE', $searchTerm)->get();
    }

    public function clear() {
        $this->reset('results', 'searchText');
    }
    
    public function render()
    {
        return view('livewire.search');
    }
}
