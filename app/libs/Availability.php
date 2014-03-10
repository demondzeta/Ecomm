<?php
/**
* clase para detectar si un producto esté disponible
*/
class Availability {
	
	public static function display($availability)
	{
		if($availability == 0){
			echo "Out of stock";
		}else if($availability == 1){
			echo "In Stock";
		}
	}

	public static function displayClass($availability)
	{
		if($availability == 0){
			echo "outstock";
		}else if($availability == 1){
			echo "instock";
		}
	}
}