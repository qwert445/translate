<?php
class Dictionary{
	public $id = 0;
	public $vietnamese = '';
	public $english = '';
	public $firstword = 0;
	public $description = '';
	
	function getword($word){
		$sql = "select vietnamese, english, firstword from tb_dictionary where vietnamese REGEXP '[[:<:]]".$word."[[:>:]]'";
		$db = MySQL::init();		
		$result = $db->execute_query($sql);
		if(isset($result[0][0])){
			$arr = array();
			$arr_value = array();
			foreach($result as $row)
			{
				$arr[] = $row['vietnamese'];
				$arr_value[$row['vietnamese']] =  $row['firstword']; 
			}
			foreach($arr as $v) 
			{ 
				$counts[] = strlen($v); 
			} 
			array_multisort($counts, $arr);
			
			return $arr_value[$arr[0]];
		}
		else
			return $word;
	}
	function getList(){
		$sql = "select * from tb_dictionary";
		$db = MySQL::init();		
		$result = $db->execute_query($sql);
		return $result;
	}
	function getListById($id){
		$sql = "select * from tb_dictionary where id = '$id'";
		$db = MySQL::init();		
		$result = $db->execute_query($sql);
		return $result[0];
	}
	
	function del($id)
	{
		$sql = "delete from tb_dictionary where id = '".$id."'";
		$db = MySQL::init();		
		$result = $db->execute_non_query($sql);
		return ( $result > 0 );
	}
	
	function insert($vietnamese,$firstword)
	{
		$sql = "insert into tb_dictionary(`vietnamese`,`firstword`) value('".$vietnamese."','".$firstword."')";
		$db = MySQL::init();		
		$result = $db->execute_non_query($sql);
		return ( $result > 0 );
	}
	
	function edit($id,$vietnamese,$firstword)
	{
		$sql = "update tb_dictionary set vietnamese = '".$vietnamese."', firstword = '".$firstword."' where id = '".$id."'";
		$db = MySQL::init();		
		$result = $db->execute_non_query($sql);
		return ( $result > 0 );
	}
	


}
?>