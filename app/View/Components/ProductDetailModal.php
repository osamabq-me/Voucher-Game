<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProductDetailModal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        // No product parameter needed
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.product-detail-modal');
    }
}
