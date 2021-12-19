<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MaterialLayout extends Component
{

    public $activePage;
    public $menuParent;
    public $titlePage = '';

    public function __construct()
    {
        //

    }

    public function render()
    {
        return view('layouts.material');
    }
}