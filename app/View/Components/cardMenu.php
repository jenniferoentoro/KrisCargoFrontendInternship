<?php

namespace App\View\Components;

use Illuminate\View\Component;

class cardMenu extends Component
{

    public $name;
    public $img;
    public $href;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $img, $href)
    {
        $this->name = $name;
        $this->img = $img;
        $this->href = $href;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card-menu');
    }
}
