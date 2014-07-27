<?php 

namespace navquery;

class Nav_Query_Meta{
	public $args;
	
	public function __construct( $object ){
		$this->args = $object;
	}
	
	public function __toString(){
		return 'nav-query';
	}
}