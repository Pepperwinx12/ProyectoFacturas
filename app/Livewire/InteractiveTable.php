<?php

namespace App\Livewire;

use Livewire\Component;

class InteractiveTable extends Component
{
    public $data = [
        ['id' => 1, 'name' => 'Category A', 'status' => 'Active'],
        ['id' => 2, 'name' => 'Category B', 'status' => 'Inactive'],
    ];

    public function render()
    {
        return view('livewire.interactive-table');
    }
}
