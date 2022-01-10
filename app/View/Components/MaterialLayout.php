<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MaterialLayout extends Component
{

    public $activePage;
    public $menuParent;

    public function __construct($activePage, $menuParent)
    {
        $this->activePage = $activePage;
        $this->menuParent = $menuParent;
    }

    public function render()
    {
        return view('layouts.material');
    }
}