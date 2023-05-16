<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class Dropdown extends Component
{
    public $newProjectName;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($newProjectName)
    {
        $this->newProjectName = $newProjectName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.inputs.dropdown');

        //или вывести прямо в компоненте без шаблона/виюхи
        //  return <<<'blade'
        // <h1>bla</h1>
        // blade;

    }

    public function myFunc($string) {
        return strtoupper($string);
    }
}
