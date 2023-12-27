<?php

namespace App\View\Components;

use Illuminate\View\Component;

class card2FA extends Component
{
      /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($data = null)
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
       return $this->data === null ? view('components.card-2fa') : view('components.card-2fa')->with('data', $this->data);
    }
}
