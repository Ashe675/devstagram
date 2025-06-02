<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Avatar extends Component
{
    public $url;
    public $class;
    public $alt;

   /**
     * Create a new component instance.
     *
     * @param string|null  $url
     * @param string|null $class
     * @param string|null $alt
     * @return void
     */
    public function __construct(?string $url = '', ?string $class = null, ?string $alt = null)
    {
        $this->url = $url == '' || !$url ? asset('img/usuario.svg') : $url;
        $this->class = $class;
        $this->alt = $alt ?? 'Avatar';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.avatar');
    }
}
