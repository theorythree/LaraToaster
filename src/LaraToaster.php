<?php

namespace TheoryThree\LaraToaster;

use Session;

class LaraToaster
{

  var $types = ['danger','warning','success','white','black','light','dark','info'];

  public function __construct()
  {

  }

  public function toast(){

    $return = '';
    foreach ($this->types as $type){
      if (Session::has($type)) {
        $return .= '<laratoaster name="laratoaster[]" message="'.Session::get($type).'" type="is-'.$type.'"></laratoaster>';
      }
    }

    if (strlen($return)>0){
      return $return;
    }
  }

  public function make($type,$message){
    return '<laratoaster name="laratoaster[]" message="'.$message.'" type="is-'.$type.'"></laratoaster>';
  }

  public function success($message){
    Session::flash('success',$message);
  }

  public function warning($message){
    Session::flash('warning',$message);
  }

  public function danger($message){
    Session::flash('danger',$message);
  }

  public function white($message){
    Session::flash("white",$message);
  }

  public function black($message){
    Session::flash("black",$message);
  }

  public function dark($message){
    Session::flash("dark",$message);
  }

  public function light($message){
    Session::flash("light",$message);
  }

  public function info($message){
    Session::flash("info",$message);
  }

  public function colored($color,$message){
    Session::flash($color,$message);
  }

}
