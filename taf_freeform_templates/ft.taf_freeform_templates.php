<?php if ( ! defined('EXT')) exit('Invalid file request');

// Get config file
require(PATH_THIRD.'taf_freeform_templates/config.php');


/**
* TAF Freeform Templates Fieldtype
*
* @package		taf-freeform-templates
* @version		1.0
* @author		Adam Wiggall ~ <adam@turnandface.com>
* @copyright	Copyright 2010, Turn and Face
*/
class Taf_freeform_templates_ft extends EE_Fieldtype {

	/**
	* Info array
	*
	* @var	array
	*/
	var $info = array(
		'name'		=> TAF_FFT_NAME,
		'version'	=> TAF_FFT_VERSION
	);

	// --------------------------------------------------------------------

	/**
	* PHP4 Constructor
	*
	* @see	__construct()
	*/
	function Taf_freeform_templates_ft()
	{
		$this->__construct();
	}

	// --------------------------------------------------------------------

	/**
	* PHP5 Constructor
	*
	* @return	void
	*/
	function __construct()
	{
		parent::__construct();
	}

	// --------------------------------------------------------------------

	/**
	* Displays the field in publish form
	*
	* @param	string
	* @param	bool
	* @return	string
	*/
	function display_field($data, $cell = FALSE)
	{
		// Load helper
		$this->EE->load->helper('form');

		// Get fields from DB
		$query = $this->EE->db->query("SELECT notification_name AS name, notification_label AS label FROM exp_freeform_notification_templates ORDER BY name ASC");

		// Generate drop down
		$options = array('' => 'Please Select...');
		foreach ($query->result_array() AS $row)
		{
			$options[$row['name']] = $row['label'];
		}

		// Field name depending on Matrix cell or not
		$field_name = $cell ? $this->cell_name : $this->field_name;

		return form_dropdown($field_name, $options, $data);
	}

	// --------------------------------------------------------------------

	/**
	* Displays the field in matrix
	*
	* @param	string
	* @return	string
	*/
	function display_cell($cell_data)
	{
		return $this->display_field($cell_data, TRUE);
	}

	// --------------------------------------------------------------------

	/**
	* Displays the field in Low Variables
	*
	* @param	string
	* @return	string
	*/
	function display_var_field($var_data)
	{
		return $this->display_field($var_data);
	}

	// --------------------------------------------------------------------

}

/* End of file ft.taf_freeform_templates_ft.php */
