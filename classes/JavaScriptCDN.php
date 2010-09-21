<?php

/*
 * 
 * CloudFrontJavaScript
 * 
 */

require_once(NINJA_BASEPATH . 'awsninja_core/db.php');

class JavaScriptCDN {

	public $Id;
	public $ScriptIds;
	public $Version;		
	public $Gzip;


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
		
		
	public function getPath()
	{
		$idStr = str_replace(',', '_', $this->ScriptIds);
		if ($this->Gzip)
		{
			return "javascript/{$this->Version}_{$idStr}.gz.js";
		}
		else
		{
			return "javascript/{$this->Version}_{$idStr}.js";		
		}
	}
	
	
	
	public static function insert(JavaScriptCDN $jss)
	{
		$db = Db::instance();
		$sql = "REPLACE INTO tbl_javaScriptCDN (scriptIds, version, gzip) VALUES (:scriptIds, :version, :gzip)";
		$vals = array(
			':scriptIds'=>$jss->ScriptIds,
			':version'=>$jss->Version,
			':gzip'=>$jss->Gzip
		);
		$id = $db->executeInsertStatement($sql, $vals);
		return $id;
	}
		
	
	public static function findByScriptIdsGzip($idsStr, $gzip)
	{
		$db = Db::instance();
		$sql = "SELECT id, scriptIds, version, gzip FROM tbl_javaScriptCDN WHERE scriptIds=:scriptIds AND gzip=:gzip";
		$vals = array(
			':scriptIds'=>$idsStr,
			':gzip'=>$gzip
		);
		$res = $db->executeSelectStatement($sql, $vals);
		if(isset($res[0]))
		{
			$r = $res[0];
			$jcdn = new JavaScriptCDN();
			$jcdn->Id = $r['id'];
			$jcdn->ScriptIds = $r['scriptIds'];
			$jcdn->Version = $r['version'];
			$jcdn->Gzip = $r['gzip'];
			return $jcdn;								
		}
		else
		{
			return null;
		}	
	}
}


?>