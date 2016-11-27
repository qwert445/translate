<?php
class MySQL
{
	//______________________________________________________________________________________
	//ATTRIBUTES
	//______________________________________________________________________________________
	//static instance of this class
	private static $m_instance;

	//______________________________________________________________________________________
	//CONSTRUCTOR and DESTRUCTOR
	//______________________________________________________________________________________
	//---------------------------------------------------------------------------
	//Constructor
	//---------------------------------------------------------------------------
	private function __construct()
	{
		global $g_config;

		//exec persistent connection
		$_link = mysql_pconnect(
								$g_config['db_server'],
								$g_config['db_username'],
								$g_config['db_password']);
   		//if connection is established
		//$db->execute_non_query("SET NAMES 'utf8'");
		mysql_query("SET NAMES 'utf8'");
   		if( $_link )
		{
			//if selecting database unsuccessful, report an error
   			if ( !mysql_select_db($g_config['db_database_name'], $_link) )
				$this->display_error();
		} 
   		else
			$this->display_error();
	}
	//---------------------------------------------------------------------------
	//Destructor
	//---------------------------------------------------------------------------
	function __destruct()
	{
		//close without report error (if any)
		@mysql_close();
	}
	//______________________________________________________________________________________
	//STATIC FUNCTIONS
	//______________________________________________________________________________________
	//---------------------------------------------------------------------------
	//function quote_smart($value)
	//Purpose	: 	escape the dangerous character (i.e. SQL Injection) and cover with single quote if it is string
	//In		:	$value : the value to process
	//Out	:	if it is string, return single quote - covered string. If not, return the processed value
	//---------------------------------------------------------------------------
   	private function quote_smart($value) {
   		// Stripslashes
    	if (get_magic_quotes_gpc())
            $value = stripslashes($value);

		// Quote if not integer
    	if (!is_numeric($value))
			$value = "'" . mysql_real_escape_string($value) . "'";
	        //$value = "'" . mysql_real_escape_string($value, self::$m_instance) . "'";
	    return $value;

   	}
	//---------------------------------------------------------------------------
	//function init($value)
	//Purpose	: 	The singleton method
	//In		:
	//Out	:	the static instance
	//---------------------------------------------------------------------------
    public static function  init()
    {
        if (!isset(self::$m_instance))
        {
			$c = __CLASS__;

			self::$m_instance = new $c;
		}
        return self::$m_instance;
    }
	//______________________________________________________________________________________
	//PRIVATE FUNCTIONS
	//______________________________________________________________________________________
	//---------------------------------------------------------------------------
	//function execute($value)
	//Purpose	: 	escape the dangerous character (i.e. SQL Injection) and cover with single quote if it is string
	//In		:	$value : the value to process
	//Out	:	if it is string, return single quote - covered string. If not, return the processed value
	//---------------------------------------------------------------------------
   	private function execute($sql)
	{
		//$_resource = mysql_query($sql, self::$m_instance);
		$_resource = mysql_query($sql);
		if( !$_resource )
			$this->display_error($sql);

		return $_resource;

   	}
	//---------------------------------------------------------------------------
	//function __clone()
	//Purpose	: 	Prevent creating multiple instances of this class
	//In		:
	//Out	:
	//---------------------------------------------------------------------------
    private function __clone()
	{

	}
	//---------------------------------------------------------------------------
	//function display_error($sql)
	//Purpose	: 	Output errors to the client
	//In		:	$sql : the sql statement (optional)
	//Out	:
	//---------------------------------------------------------------------------
	private function display_error($sql = '')
	{
		$str = '<br><font color="red">Error code: <b>' . mysql_errno() . '</b>' .
			'<br>Error message: <b><i>' . mysql_error() . '</i></b>' .
			'<br>Time: <b><i>' . date('Y-m-d G:i:s B') . '</i></b>';
		if( !empty($sql) )
			$str .= '<br>SQL statement: <b>' . $sql . '</b>';

		die($str);
	}

	//---------------------------------------------------------------------------
	//function bind_params($arg_list)
	//Purpose	: 	Replace param ? with the value
	//In		:	$arg_list : list of arguments
	//Out		:	processed-sql statement
	//---------------------------------------------------------------------------
	private function bind_params($arg_list)
	{
	  	$sql = '';
	  	$numargs = count($arg_list);

	  	if( $numargs == 0)
   			return $sql;
   		//get the SQL Statement that is provided on the 1st index of arg_list
		$sql = $arg_list[0];

		$params = explode('?', $sql);
	  	if( $numargs > 1)
		{
		  	$sql = $params[0];
	  		for( $i = 1 ; $i < $numargs ; $i++)
		    	$sql .= $this->quote_smart($arg_list[$i]) . $params[$i];
		}

		return $sql;
	}
	//______________________________________________________________________________________
	//PUBLIC FUNCTIONS
	//______________________________________________________________________________________
	//---------------------------------------------------------------------------
	//function execute_non_query($sql)
	//Purpose	: 	Execute NON-RETURNED-RESULTS queries (such as: INSERT, UPDATE, DELTETE ... )
	//In		:	$sql : the sql statement
	//Out	:	if excution is success, return number of affected records. If fail, FALSE will be returned
	//---------------------------------------------------------------------------
   	public function execute_non_query()
	{
   		//get the argument list
	  	$arg_list = func_get_args();
	  	$sql = $this->bind_params($arg_list); //bind with params

		//execute sql
		$_resource = $this->execute($sql);

   		if( $_resource )
		{
			$r_affected_records = 0;
			$r_affected_records = mysql_affected_rows();

   			@mysql_free_result($_resource);

   			if( $r_affected_records == 0)
   				return false;

   			if ($r_affected_records > 0)
				return $r_affected_records ;
		}
		return false;

   	}
   	//---------------------------------------------------------------------------
	//function execute_query($sql)
	//Purpose	: 	Execute RETURNED-RESULTS queries(such as: SELECT, ... )
	//In		:	$sql : the sql statement
	//Out	:	if excution is success, return set of records. If fail, FALSE will be returned
	//---------------------------------------------------------------------------
   	public function execute_query()
	{
		//get the argument list
	  	$arg_list = func_get_args();
	  	$sql = $this->bind_params($arg_list); //bind with params

		//execute query
   		$_resource = $this->execute($sql);

	   	if( $_resource )
		{
			if( @mysql_num_rows($_resource) > 0 )
			{
				$_result_array = array();

				$_num_rec = 0;
				while($_row = mysql_fetch_array($_resource))
				{
					$_result_array[$_num_rec] = $_row;
					$_num_rec++;
				}
				@mysql_free_result($_resource);

				if( $_num_rec == 0)
   					return false;

	   			if ($_num_rec > 0 )
	   				return $_result_array;
			}

			return false;
		}
		$this->display_error();
		return false;
   	}
   	//---------------------------------------------------------------------------
	//function execute_scalar($sql)
	//Purpose	: 	Execute ONEVALUE-RETURNED queries(such as: SELECT average, SELECT COUNT, ... )
	//In		:	$sql : the sql statement
	//Out	:	if excution is success, return 1st value of 1st records. If fail, FALSE will be returned
	//---------------------------------------------------------------------------

   	public function execute_scalar()
	{
		//get the argument list
	  	$arg_list = func_get_args();
	  	$sql = $this->bind_params($arg_list); //bind with params

		//execute query
		$_resource = $this->execute($sql);


		if( $_resource )
		{
			if( mysql_num_rows($_resource) > 0 )
			{
				$_row = mysql_fetch_row($_resource);
				@mysql_free_result($_resource);

				return $_row[0];
			}
		}
		return false;
   	}
	//---------------------------------------------------------------------------
	//function get_num_recs($sql)
	//Purpose	: 	Get the recordcount of queries
	//In		:	$sql : the sql statement
	//Out	:	if excution is success, return number of records . If fail, zero will be returned
	//---------------------------------------------------------------------------
	public function get_num_recs()
	{
	   	//get the argument list
	  	$arg_list = func_get_args();
	  	$sql = $this->bind_params($arg_list); //bind with params

		$_resource = $this->execute($sql);

		if( $_resource )
		{
			$ret = mysql_num_rows($_resource);
			mysql_free_result($_resource);

			return $ret;
		}
		return 0;
   	}
}
?>