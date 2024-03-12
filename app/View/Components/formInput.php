<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formInput extends Component
{
    public $input_fields;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($input_fields)
    {
        $this->input_fields = $input_fields;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-input');
    }
}
