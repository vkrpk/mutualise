<?php

namespace App\View\Components;

use Illuminate\View\Component;

class adressesCard extends Component
{
    /**
     * Route
     * 
     * @var string
     */
    public $address;
    public $form;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($address, $form)
    {
        $this->address = $address;
        $this->form = $form;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.adresses-card');
    }
}
