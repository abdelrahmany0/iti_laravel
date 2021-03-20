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
    private $content;
    private $href;
    public function __construct($type ,$content ,$href = null)
    {
        // var_dump($type);
        $this->type = $type;
        $this->content = $content;
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
        if(isset($this->href)){
            return view('components.button',
            [
                'type' => $this->type,
                'content' => $this->content,
                'href' => $this->href
            ]);
        } else {
            return view('components.button',
        [
            'type' => $this->type,
            'content' => $this->content
        ]);
        }
        
    }
}
