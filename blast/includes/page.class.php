<?php

class Page {
	
	public $login_required = true;
	
	private $name;
	private $slug;
	
	public function __construct($name, $slug) { 
		$this->name = $name;
		$this->slug = $slug;
	}
	
	/**
	 * Run prior to first theme file being loaded. 
	 */
	public function init() {  }
	
	/**
	 * Run between header and footer being loaded. 
	 */
	public function content() {  }
	
	/**
	 * Returns the name of the page.
	 * @return String Title of page.
	 */
	public function get_name() { return $this->name; }
	
	/**
	 * Returns the slug of the page.
	 * @return String Page identifier.
	 */
	public function get_slug() { return $this->slug; }
		
}


?>
