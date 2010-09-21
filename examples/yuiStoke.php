#!/usr/bin/php -q
<?php

/*
 * Script to load the YUI scripts into tbl_javaScriptScript.
 * 
 * This isn't the most efficient or elegant, but it effectively stokes the data.
 * 
 */

define('NINJA_BASEPATH', dirname(__FILE__) . '/../../');
require_once(NINJA_BASEPATH . 'awsninja_cloudfrontjavascript/CloudFrontJavaScriptService.php');

require_once('yuijson.php');  //the file with they YUI dependenices

$workingSet = array();

foreach($yui_moduleInfo as $modKey=>$conf)
{
	if ($conf['type'] == 'js')
	{
		if(!isset($workingSet[$modKey]))
		{
			$mastSortOrder = (count($workingSet)+1)*(5);
			$workingSet[$modKey] = array(
				'sortOrder'=>$mastSortOrder
			);
			
			if (isset($conf['requires']))
			{
				$workingSet[$modKey]['dependencies'] = $conf['requires'];
			}
			else
			{
				$workingSet[$modKey]['dependencies'] = array();
			}
			
		}
		
		if (isset($conf['requires']))
		{
			// make sure all of the requirements are set up first.
			for($i=0;$i<count($conf['requires']); $i++)
			{
				$depen = $conf['requires'][$i];
				if (!isset($workingSet[$depen]))
				{
					$so = (count($workingSet)+1)*5;
					$workingSet[$depen] = array('sortOrder'=>$so);
					$depenConf = $yui_moduleInfo[$depen];
					if ($depenConf['type'] == 'js')
					{
						if (isset($depenConf['requires']))
						{
							$workingSet[$depen]['dependencies'] = $depenConf['requires'];
						}
						else
						{
							$workingSet[$depen]['dependencies'] = array();
						}
					}
				}
			}
			//ensure that the sort order is rational
			rationalizeSortOrder($workingSet, $modKey, $conf['requires']);
		}
	}
}

//add the script paths
foreach($workingSet as $key=>$obj)
{
	$augmentedObj = $obj;
	$augmentedObj['path'] = str_replace('-min', '', $yui_moduleInfo[$key]['path']);
	$workingSet[$key] = $augmentedObj;
}


$workingSetBySortOrder = array();
foreach($workingSet as $key=>$obj)
{
	$sortOrder = $obj['sortOrder'];
	$obj['key'] = $key;
	$workingSetBySortOrder[$sortOrder] = $obj;
}
ksort($workingSetBySortOrder);


$scriptsById = array();
$scriptIdsByKey = array();

foreach($workingSetBySortOrder as $sortOrder=>$obj)
{
	$jss = new JavaScriptScript();
	$jss->LookupId = $sortOrder;
	$jss->FileName = str_replace('/', '_', $obj['path']);		
	$jss->SortOrder = $sortOrder;

	$depCt = count($obj['dependencies']);
	$depStr = '';
	for($i=0;$i<$depCt; $i++)
	{
		$depKey = $obj['dependencies'][$i];
		$depId = $scriptIdsByKey[$depKey];
		if ($i == $depCt-1)
		{
			$depStr .= $depId;
		}
		else
		{
			$depStr .= $depId . ',';
		}
	}
	$jss->Dependencies = $depStr;
	$jss->save();
	$scriptsById[$jss->Id] = $jss;
	$scriptIdsByKey[$obj['key']] = $jss->LookupId;
	
}




echo("Done!\n");
exit;


function rationalizeSortOrder(&$workingSet, $mastKey, $dependencies)
{
	$sortsPutted = array();
	//all dependecies must have a lower sort order than the mast key
	$mastSort = $workingSet[$mastKey]['sortOrder'];
	$depCt = count($dependencies);
	for($i=0;$i<$depCt; $i++)
	{
		$depenKey = $dependencies[$i];
		$depenSort = $workingSet[$depenKey]['sortOrder'];
		if ($depenSort > $mastSort)
		{
			//need to fix sort
			$suggestedSort = $mastSort-1;
			while(in_array($suggestedSort, $sortsPutted))
			{
				if ($suggestedSort % 5 != 0)
				{
					$suggestedSort = $suggestedSort-1;
				}
				else
				{
					$suggestedSort = $suggestedSort-2;
				}
			}
			$sortsPutted[] = $suggestedSort;
			$workingSet[$depenKey]['sortOrder'] = $suggestedSort;
		}
	}
	$workingSet = repadSorts($workingSet);
}


function repadSorts($workingSet)
{
	$scriptsBySort = array();
	foreach($workingSet as $key=>$obj)
	{
		$sort = $obj['sortOrder'];
		if (isset($scriptsBySort[$sort]))
		{
			throw new Exception('duplicate sort order ' . $sort);
		}
		$scriptsBySort[$sort] = $key;
	}
	//sort by keys
	ksort($scriptsBySort);
	$sortsOnFives = array();
	$sortPoint = 0;
	foreach($scriptsBySort as $sort=>$script)
	{
		$sortPoint += 5;
		$workingSet[$script]['sortOrder'] = $sortPoint;
	}
	return $workingSet;
}


?>