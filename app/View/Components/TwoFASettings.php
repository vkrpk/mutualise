<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TwoFASettings extends Component
{
    /**
     * data
     * 
     * @var mixed
     */
    public $data;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // dd($this->data);
        return view('components.two-f-a-settings')->with('data', $this->data);
    }
}
