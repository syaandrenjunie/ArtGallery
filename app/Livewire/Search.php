<?php
namespace App\Livewire;
use Livewire\Component;
use App\Models\Category;
class Search extends Component
{
    public $searchText = '';
    public $categories = [];
    public $results = [];
    public $placeholder;
    
    public function mount()
    {
        if (request()->routeIs('categories.index')) {
            $this->categories = Category::all();
        }
    }
    public function updatedSearchText($value)
    {
        $this->reset('results');

        if (empty(trim($value))) {
            return;
        }

        $searchTerm = "%{$value}%";
        $this->results = Category::where('name', 'LIKE', $searchTerm)->get();
    }
    public function clear()
    {
        $this->reset('results', 'searchText');
    }
    public function render()
    {
        return view('livewire.search');
    }
}