<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class Servers extends Component
{

     public $data ;
     public $type ;
     public $typeserver ;

     public function __construct($data,$type,$typeserver)
     {
       $this->data = $data ;
       $this->type = $type ;
       $this->typeserver = $typeserver ;
     }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.admin.servers',["data" => $this->data,"type" => $this->type,"typeserver" => $this->typeserver]);
    }
}
