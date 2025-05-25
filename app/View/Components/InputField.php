<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputField extends Component
{
  public $label;
  public $type;
  public $name;
  public $id;
  public $ft;
  public $sd;
  public $required;
  public $disabled;
  public $readonly;
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($label, $type, $name, $id, $ft, $sd, $required = null, $disabled = null, $readonly = null)
  {
    $this->label = $label;
    $this->type = $type;
    $this->name = $name;
    $this->id = $id;
    $this->ft = $ft;
    $this->sd = $sd;
    $this->required = $required;
    $this->disabled = $disabled;
    $this->readonly = $readonly;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('components.input-field');
  }
}
