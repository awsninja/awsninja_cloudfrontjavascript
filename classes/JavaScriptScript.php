<?php

/*
 * 
 * CloudFrontJavaScript
 * 
 */


require_once(NINJA_BASEPATH . 'awsninja_cloudfrontjavascript/config.php');
require_once(NINJA_BASEPATH . 'awsninja_core/db.php');

class JavaScriptScript {

	public $Id;
	public $LookupId;
	public $FileName;		
	public $Dependencies;
	public $SortOrder;


	public function save() 
	{
		if (isset($this->Id))
		{
			self::update($this);
		}
		else
		{
			$id = self::insert($this);
			$this->Id = $id;
		}
	 	return true;
	}
		
		
	public static function insert(JavaScriptScript $jss)
	{
		$db = Db::instance();
		$sql = "INSERT INTO tbl_javaScriptScript (lookupId, fileName, dependencies, sortOrder) VALUES (:lookupId, :fileName, :dependencies, :sortOrder)";
		$vals = array(
			':lookupId'=>$jss->LookupId,
			':fileName'=>$jss->FileName,
			':dependencies'=>$jss->Dependencies,
			':sortOrder'=>$jss->SortOrder
		);
		$id = $db->executeInsertStatement($sql, $vals);
		return $id;
	}
		
	
	public static function findAll()
	{
	 	$db = Db::instance();
		$sql = 'SELECT id, lookupId, fileName, dependencies, sortOrder FROM tbl_javaScriptScript';
		$vals = array();
		$res = $db->executeSelectStatement($sql, $vals);
		$resCt = count($res);
		$results = array();
		for($i=0; $i<$resCt; $i++)
		{
			$r = $res[$i];
			$jss = new JavaScriptScript();
			$jss->Id = $r['id'];
			$jss->LookupId = $r['lookupId'];
			$jss->FileName = $r['fileName'];
			$jss->Dependencies = $r['dependencies'];
			$jss->SortOrder = $r['sortOrder'];
			$results[] = $jss;							
		}
		return $results;
	}
	
	public static function findByLookupId($lookupId)
	{
	 	$db = Db::instance();
		$sql = "SELECT id, lookupId, fileName, dependencies, sortOrder FROM tbl_javaScriptScript WHERE lookupId=:lookupId";
		$vals = array(
			':lookupId'=>$lookupId
		);
		$res = $db->executeSelectStatement($sql, $vals);
		if(isset($res[0]))
		{
			$r = $res[0];
			$jss = new JavaScriptScript();
			$jss->Id = $r['id'];
			$jss->LookupId = $r['lookupId'];
			$jss->FileName = $r['fileName'];
			$jss->Dependencies = $r['dependencies'];
			$jss->SortOrder = $r['sortOrder'];
			return $jss;								
		}
		else
		{
			return null;
		}
	}	

}

?>
