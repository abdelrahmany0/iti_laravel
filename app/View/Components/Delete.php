<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Delete extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    private $action;
    public function __construct($action)
    {
        $this->action = $action;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.delete',[
            'action' => $this->action
        ]);
    }
}
