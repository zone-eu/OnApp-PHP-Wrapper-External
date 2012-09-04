<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Provisioning Profile
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Manages User Profile
 *
 * The OnApp_Payment class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Profile extends OnApp {
	/**
	 * Magic properties
	 *
	 * @property datetime created_at
	 * @property datetime activated_at
	 * @property integer  memory_available
	 * @property integer  used_memory
	 * @property float    outstanding_amount
	 * @property datetime suspend_at
	 * @property datetime remember_token_expires_at
	 * @property float    total_amount
	 * @property datetime updated_at
	 * @property datetime deleted_at
	 * @property integer  billing_plan_id
	 * @property integer  used_disk_size
	 * @property integer  id
	 * @property integer  group_id
	 * @property integer  user_group_id
	 * @property integer  disk_space_available
	 * @property integer  used_cpu_shares
	 * @property decimal  payment_amount
	 * @property integer  remember_token
	 * @property string   last_name
	 * @property string   time_zone
	 * @property string   locale
	 * @property integer  image_template_group_id
	 * @property integer  used_cpus
	 * @property string   status
	 * @property string   login
	 * @property string   first_name
	 * @property string   email
	 * @property bolean   update_billing_stat
	 */

	public static $nestedData = array(
		'roles' => 'Role',
		'used_ip_addresses' => 'IpAddress',
	);

	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $_tagRoot = 'user';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $_resource = 'profile';

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}

	function activate( $action_name ) {
		switch( $action_name ) {
			case ONAPP_ACTIVATE_GETLIST:
			case ONAPP_ACTIVATE_DELETE:
				exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
				break;
		}
	}

	/**
	 * Returns the URL Alias of the API Class that inherits the OnApp class
	 *
	 * @param string $action action name
	 *
	 * @return string API resource
	 * @access public
	 */
	function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		/**
		 * ROUTE :
		 *
		 * @name profile
		 * @method GET
		 * @alias    /profile(.:format)
		 * @format   {:controller=>"users", :action=>"profile"}
		 */
		$resource = $this->_resource;
		$this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );

		return $resource;
	}

	/**
	 * Sends an API request to get the Object after sending,
	 * unserializes the response into an object
	 *
	 * The key field Parameter ID is used to load the Object. You can re-set
	 * this parameter in the class inheriting OnApp class.
	 *
	 * @param integer $id Object id
	 *
	 * @return mixed serialized Object instance from API
	 * @access public
	 */
	function load( $id = null ) {
		$this->activate( ONAPP_ACTIVATE_LOAD );

		$this->logger->add( "load: Load class" );

		$this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_LOAD ) );

		$response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

		$result = $this->_castResponseToClass( $response );

		$this->_obj = $result;

		return $result;
	}
}