<?php

namespace App\View\Components\Generals\User;

use Illuminate\View\Component;

class Signup extends Component
{

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
     public $logo ;

     public function __construct($logo=null)
     {


         $this->logo = $logo;


     }
    public function render()
    {

        return view('components.generals.user.signup',["logo"=> $this->logo]);
    }
}
