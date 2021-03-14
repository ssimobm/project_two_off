<?php

namespace App\View\Components\Generals;

use Illuminate\View\Component;

class cardMovieSlider extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
     public $data ;
     public $nm ;

     public function __construct($data,$nm=null)
     {
       $this->data = $data ;
       $this->nm = $nm ;
     }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.generals.card-movie-slider',["data" => $this->data,"nm" => $this->nm]);
    }
}
