<?php
class Pizza{
  var $ID;
  var $bezeichnung;
  var $pizzaPreis;
  var $imgpath;
}
protected function __construct()
{
    parent::__construct(  $ID, $pizzaBezeichung, $pizzaPreis, $imgpath);
    this->$ID = $ID;
    this->$pizzaBezeichung = $pizzaBezeichung;
    this -> $pizzaPreis = $pizzaPreis;
    this -> $imgpath = $imgpath;
}


 ?>
