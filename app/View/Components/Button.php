<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    private $type;
    private $href;
    public function __construct($type ,$href = null)
    {
        // var_dump($type);
        $this->type = $type;
        if($href != null){
            $this->href = $href;
        }
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button',
        [
            'type' => $this->type,
            'href' => $this->href
        ]);

    }
}
