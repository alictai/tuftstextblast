<?php

class PageAction {
	
	/**
	 * Data of registered page types.<br />
	 * Array key is page slug, array value is page class name.
	 * @var Array 
	 */
	static $registered = array();
	
	/**
	* Adds data to the list of existing page types.
	* @param String $slug Filename and query string used to reference page.
	* @param String $class Name of class containing page data.
	*/
	static function Register($slug, $class) {
		PageAction::$registered[$slug] = $class;
	}
	
	/**
	* Determine if a page type has been loaded and defined.
	* @param String $search_slug Slug to search for
	* @return boolean Returns true if type exists, false otherwise.
	*/
	static function IsRegistered($search_slug) {
		return array_key_exists($search_slug, PageAction::$registered);
	}
	
	/**
	* Get the class name based on the page slug.
	* @param String $slug Slug to get class name for
	* @return null|String Returns class name if registered, null otherwise.
	*/
	static function GetBySlug($slug) {
		if (!PageAction::IsRegistered($slug)) { return null; }
		return PageAction::$registered[$slug];
	}
	
	/**
	* Determines the action to be taken by the system based on query string and other values.
	* @return String Slug of page to be loaded.
	*/
	static function GetAction() {
		global $user;
		
		if (!isSet($_GET['p'])) { $action = 'home'; }
		else if (!is_registered_page_type($_GET['p'])) { $action = '404'; }
		else { $action = $_GET['p']; }
		
		//if (!$user->is_logged_in()) { $action = 'login'; }
	
		return $action;
		
	}
	
	/**
	* Sets global page variable to type determined by get_page_action.
	* @return mixed Page object for current action.
	*/
	static function SetAction() {
		$slug = PageAction::GetBySlug(PageAction::GetAction());
		return new $slug;
	}
	
	static function CheckAuthorization() {
		global $page, $user;
		
		if (!$page->login_required) { return true; }
		
		if (!$user->is_authorized($page->required_level)) {
			header('Location: '.SITEPATH.'/?p=login&msg=authreq');
		}
		
	}
	
}





/**
 * Determines the action to be taken by the system based on query string and other values.
 * @return String Slug of page to be loaded.
 */
function get_page_action() {
	return PageAction::GetAction();
}

/**
 * Sets global page variable to type determined by get_page_action.
 * @return mixed Page object for current action.
 */
function set_page_action() {
	return PageAction::SetAction();
}

/**
 * Adds data to the list of existing page types.
 * @param String $slug Filename and query string used to reference page.
 * @param String $class Name of class containing page data.
 */
function register_page_type($slug, $class) {
	PageAction::Register($slug, $class);
}


/**
 * Determine if a page type has been loaded and defined.
 * @param String $search_slug Slug to search for
 * @return boolean Returns true if type exists, false otherwise.
 */
function is_registered_page_type($search_slug) {
	return PageAction::IsRegistered($search_slug);
}

/**
 * Get the class name based on the page slug.
 * @param String $slug Slug to get class name for
 * @return null|String Returns class name if registered, null otherwise.
 */
function get_page_type_by_slug($slug) {
	return PageAction::GetBySlug($slug);
}


/**
 * Outputs data from page controller to theme.
 * @global Page $page 
 */
function the_content() {
	global $page;
	$page->content();
}

/**
 * Outputs title for top of page, as defined in class.
 * @global Page $page 
 */
function the_title() {
	global $page;
	echo $page->get_name();
}



?>