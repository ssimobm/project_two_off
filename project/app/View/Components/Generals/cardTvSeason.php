<?php

namespace App\View\Components\Generals;

use Illuminate\View\Component;

class cardTvSeason extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
     public $data ;
     public $delet ;
     public $nm ;
     public $typename;

     public function __construct($data,$nm=null,$delet=null,$typename=null)
     {
       $this->data = $data ;
       $this->nm = $nm ;
       $this->delet = $delet ;
       $this->typename = $typename ;
     }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {

        return view('components.generals.card-tv-season',["data" => $this->data,"nm" => $this->nm,"delet" => $this->delet,"typename" => $this->typename]);
    }
}
