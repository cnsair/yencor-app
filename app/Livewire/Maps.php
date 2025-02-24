<?php

namespace App\Livewire;

use Livewire\Component;

class Maps extends Component
{
    protected $listeners = ['refreshMap' => 'render'];

    public function render()
    {
        return view('livewire.maps');
    }

}
