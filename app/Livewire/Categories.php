<?php

namespace App\Livewire;

use Livewire\Component;

class Categories extends Component
{

    /*
    public function render()
    {
        return view('livewire.categories', [
            'title' => 'Gestión de Categorías',
        ]);
    }
    */

    public function render()
    {
        return view('livewire.categories'); // Solo retorna la vista
    }
}
