<?php
/**
 * CloudFrontJavascript Service
 * 
 * A PHP library for managing your JavaScript on CloudFront.
 * 
 * @author Jay Muntz
 * 
 * Copyright 2010 Jay Muntz (http://www.awsninja.com)
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * “Software”), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 * 
 *
 */

require_once(NINJA_BASEPATH . 'awsninja_cloudfrontjavascript/classes/JavaScriptScript.php');
require_once(NINJA_BASEPATH . 'awsninja_cloudfrontjavascript/classes/JavaScriptCDN.php');
require_once(NINJA_BASEPATH . 'awsninja_core/S3Service.php');


class CloudFrontJavaScriptService
{
	
	/**
	 * Get the script HTML to insert into your web page
	 * @param string $idsStr
	 */
	public function getScriptHTML($idsStr, $forceMaintenceMode=false, $forceCompressed=false)
	{
		if (CDN_MAINTENANCE_MODE || $forceMaintenceMode)
		{
			$resAry = $this->buildTheCompleteResourceArray($idsStr);
			$result = '';
			$randomString = $this->getRandomString(5);
			foreach ($resAry as $s)
			{
				$result = $result	. '<script type="text/javascript" src="/javascript' . $this->reconstructScriptPath($s->FileName). '?cacheBust=' . $randomString . '"></script>' . "\n" ;
			}
			return $result;
		}
		else
		{
			$version = $this->getVersionDate();

			if ($forceCompressed)
			{
				$canGzip = true;
			}
			else
			{
				$canGzip = $this->checkCanGzip();
			}

			$scriptCdn = JavaScriptCDN::findByScriptIdsGzip($idsStr, $canGzip);
			if (!isset($scriptCdn) || $scriptCdn->Version < $version)
			{
				//need to package and upload
				$script = $this->GetCombinedScript($idsStr);
				$s3 = new S3Service();
				$newScriptCdn = new JavaScriptCDN();
				$newScriptCdn->Gzip = $canGzip;
				$newScriptCdn->ScriptIds = $idsStr;
				$newScriptCdn->Version = $version;
				$newScriptCdn->save();
				$pth = $newScriptCdn->getPath();
				$headers = array(
					'Cache-Control'=>'max-age=315360000',
					'Content-Type'=>'application/javascript'
				);
				if ($canGzip)
				{
					$gzipedScript = gzencode($script);
					$headers['Content-Encoding'] = 'gzip';
					$s3->putObject($gzipedScript, CDN_BUCKET, $pth, $acl = S3Service::ACL_PUBLIC_READ, array(), $headers);
				}
				else
				{
					$s3->putObject($script, CDN_BUCKET, $pth, $acl = S3Service::ACL_PUBLIC_READ, array(), $headers);
				}
				$scriptCdn = $newScriptCdn;
			}
	 		return '<script src="http://' . CDN_DOMAIN_NAME . '/' . $scriptCdn->getPath() . '"></script>';
		}
	}
	
	/**
	 * Get a JavaScriptScript object by it's lookupId
	 * @param int $id
	 */
	private function retrieveScriptObjectById($id)
	{
	 	$scpt = JavaScriptScript::findByLookupId($id);
		return $scpt;
	}

	/**
	 * Check to see if the requesting browser supports gzip.  Will return false in non-web context.
	 */
	private function checkCanGzip()
	{
		if (isset($_SERVER['HTTP_ACCEPT_ENCODING']))
		{
			$accept = $_SERVER['HTTP_ACCEPT_ENCODING']; //apparantly some browsers won't send this flag
		}
		else
		{
			return false;
		}
		if(strpos($accept, 'gzip') !== false)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
		
	/**
	 * Unix timestamp that represents the current version of the JavaScript codebase
	 * @var int
	 */
	private $versionDate;

	/**
	 * Gets the current version date as a Unix timestamp.  If the file holding the version date is missing,
	 * will create a new verson with the current timestamp
	 */
	private function getVersionDate()
	{
		if (!isset($this->versionDate))
		{
			$pth = CDN_VERSION_FILE;
			if (!file_exists($pth))
			{
				$fh = fopen($pth, 'w');
				fwrite($fh, (string)time());
				fclose($fh);				
			}
			$this->versionDate = file_get_contents($pth);
		}
		return $this->versionDate;
	}
		
	/**
	 * Get a random string
	 * @param int $len
	 */
	private function getRandomString($len=5)
	{
		$chars = 'abcdefghijkmnopqrstuvwxyz0123456789';
		srand((double)microtime()*1000000);
		$i = 0;
		$str = '' ;
		while ($i < $len)
		{
			$num = rand() % 33;
			$tmp = substr($chars, $num, 1);
			$str = $str . $tmp;
			$i++;
		}
		return $str;
	}

	/**
	 * Takes a comma-delimited list of JavaScriptScript lookupIds and returns an ordered array of JavaScriptScript objects
	 * @param string $lookupIdsStr
	 */
	private function buildTheCompleteResourceArray($lookupIdsStr)
	{
		$resAry = array();
		$resStr = '';
		$depAry = split(',', $lookupIdsStr);
		foreach ($depAry as $id)
	 	{
	 		$scpt = $this->retrieveScriptObjectById($id);
	 		if (!isset($scpt))
	 		{
	 			throw new Exception("Script id $id not found");
	 		}
	 		$this->appendToResultAry($resAry, $scpt);
		}
//		function sortOrderSort (JavaScriptScript $a, JavaScriptScript $b)
//		{
//			$aSort = $a->SortOrder;
//			$bSort = $b->SortOrder;
//			if ($aSort === $bSort)
//			{
//					return 0;
//			}
//			return ($aSort > $bSort) ? 1 : - 1;
//		}
		usort($resAry, array('CloudFrontJavaScriptService', 'sortOrderSort'));
		return $resAry;
	}
		
	
	public static function sortOrderSort(JavaScriptScript $a, JavaScriptScript $b)
	{
		$aSort = $a->SortOrder;
		$bSort = $b->SortOrder;
		if ($aSort === $bSort)
		{
				return 0;
		}
		return ($aSort > $bSort) ? 1 : - 1;		
	}
	
	/**
	 * Takes a comma-delimited list of JavaScriptScript lookupIds and returns the combinined and minimized JavaScript.
	 * @param string $lookupIdsStr
	 */
	private function GetCombinedScript($lookupIdsStr)
	{
		$resAry = $this->buildTheCompleteResourceArray($lookupIdsStr);
		$packingList = "/**\n * **PACKING LIST**\n *\n";
		$resStr = '';
		foreach ($resAry as $s)
		{
				$packingList = $packingList . ' * ' . $s->FileName . "\n";
				$resStr = $resStr . $this->getScriptCode($s);
		}
		$packingList = $packingList . ' *' . "\n";
		$packingList = $packingList . ' *	**DEBUG SCRIPTS**' . "\n";
		
		foreach ($resAry as $s)
		{
				$packingList = $packingList . '' . '<script src="/javascript' . $this->reconstructScriptPath($s->FileName) . '"></script>'."\n";
		}
		$packingList = $packingList . " *" . "\n";
		$packingList = $packingList . " **/\n\n";
		$resStr = $packingList . $resStr;
		return $resStr;
	}

	/**
	 * Gets the miniized JavaScript code for a JavaScriptScript object
	 * @param JavaScriptScript $jss
	 */
	private function getScriptCode(JavaScriptScript $jss)
	{
		$codePath = CDN_JAVASCRIPT_MIN_PATH . $jss->FileName;
		return file_get_contents($codePath);
	}
		
	/**
	 * Takes the JavaScript filenames like script_script.js and returns script/script.js
	 * @param $fileName
	 */
	private function reconstructScriptPath($fileName)
	{
		$parts = split('_', $fileName);
		$res = '';
		foreach($parts as $part)
		{
			$res = $res . '/' . $part;
		}
		return $res;
	}
		
	/**
	 * A recursive array for adding appending the dependencies of a JavaScriptScript object.
	 * @param Array $resAry
	 * @param JavaScriptScript $s
	 */
	private function appendToResultAry(&$resAry, JavaScriptScript $s)
	{
		if (!array_key_exists($s->LookupId, $resAry))
		{
				$resAry[$s->LookupId] = $s;
		}
		$dependencies = explode(',', $s->Dependencies);
		$depCt = count($dependencies);
		for($i=0; $i<$depCt; $i++)
		{
			$dependency = trim($dependencies[$i]);
			if (strlen($dependency) > 0)
			{
				$scriptObj = $this->retrieveScriptObjectById($dependency);
				if (get_class($scriptObj) != 'JavaScriptScript')
				{
					throw new exception("Huh?  The object is not a JavaScriptScript class.");
				}
		 		$this->appendToResultAry($resAry, $scriptObj);
			}
		}
	}
}


?>