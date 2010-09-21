<?php


//YUI Scripts and Dependencies.  Source:
//http://old.nabble.com/Re:-yui-dependency-tree-for-use-in-php.-p22585940.html

$yui_moduleInfo = array( 

        'animation' => array( 
                'type' => 'js', 
                'path' => 'animation/animation-min.js', 
                'requires' => array('dom', 'event') 
        ), 

        'autocomplete' => array( 
                'type' => 'js', 
                'path' => 'autocomplete/autocomplete-min.js', 
                'requires' => array('dom', 'event', 'datasource'), 
                'optional' => array('connection', 'animation'), 
                'skinnable' => true 
        ), 

        'base' => array( 
                'type' => 'css', 
                'path' => 'base/base-min.css', 
                'after' => array('reset', 'fonts', 'grids') 
        ), 

        'button' => array( 
                'type' => 'js', 
                'path' => 'button/button-min.js', 
                'requires' => array('element'), 
                'optional' => array('menu'), 
                'skinnable' => true 
        ), 

        'calendar' => array( 
                'type' => 'js', 
                'path' => 'calendar/calendar-min.js', 
                'requires' => array('event', 'dom'), 
                'skinnable' => true 
        ), 

        'carousel' => array( 
                'type' => 'js', 
                'path' => 'carousel/carousel-min.js', 
                'requires' => array('element'), 
                'optional' => array('animation'), 
                'skinnable' => true 
        ), 

        'charts' => array( 
                'type' => 'js', 
                'path' => 'charts/charts-min.js', 
                'requires' => array('element', 'json', 'datasource') 
        ), 

        'colorpicker' => array( 
                'type' => 'js', 
                'path' => 'colorpicker/colorpicker-min.js', 
                'requires' => array('slider', 'element'), 
                'optional' => array('animation'), 
                'skinnable' => true 
        ), 

        'connection' => array( 
                'type' => 'js', 
                'path' => 'connection/connection-min.js', 
                'requires' => array('event') 
        ), 

        'container' => array( 
                'type' => 'js', 
                'path' => 'container/container-min.js', 
                'requires' => array('dom', 'event'), 
                // button is also optional, but this creates a circular 
                // dependency when loadOptional is specified. button 
                // optionally includes menu, menu requires container. 
                'optional' => array('dragdrop', 'animation', 'connection'), 
                'supersedes' => array('containercore'), 
                'skinnable' => true 
        ), 

        'containercore' => array( 
                'type' => 'js', 
                'path' => 'container/container_core-min.js', 
                'requires' => array('dom', 'event'), 
                'pkg' => 'container' 
        ), 

        'cookie' => array( 
                'type' => 'js', 
                'path' => 'cookie/cookie-min.js', 
                'requires' => array('yahoo') 
        ), 

        'datasource' => array( 
                'type' => 'js', 
                'path' => 'datasource/datasource-min.js', 
                'requires' => array('event'), 
                'optional' => array('connection') 
        ), 

        'datatable' => array( 
                'type' => 'js', 
                'path' => 'datatable/datatable-min.js', 
                'requires' => array('element', 'datasource'), 
                'optional' => array('calendar', 'dragdrop', 'paginator'), 
                'skinnable' => true 
        ), 

        'dom' => array( 
                'type' => 'js', 
                'path' => 'dom/dom-min.js', 
                'requires' => array('yahoo') 
        ), 

        'dragdrop' => array( 
                'type' => 'js', 
                'path' => 'dragdrop/dragdrop-min.js', 
                'requires' => array('dom', 'event') 
        ), 

        'editor' => array( 
                'type' => 'js', 
                'path' => 'editor/editor-min.js', 
                'requires' => array('menu', 'element', 'button'), 
                'optional' => array('animation', 'dragdrop'), 
                'supersedes' => array('simpleeditor'), 
                'skinnable' => true 
        ), 

        'element' => array( 
                'type' => 'js', 
                'path' => 'element/element-min.js', 
                'requires' => array('dom', 'event') 
        ), 

        'event' => array( 
                'type' => 'js', 
                'path' => 'event/event-min.js', 
                'requires' => array('yahoo') 
        ), 

        'fonts' => array( 
                'type' => 'css', 
                'path' => 'fonts/fonts-min.css' 
        ), 

        'get' => array( 
                'type' => 'js', 
                'path' => 'get/get-min.js', 
                'requires' => array('yahoo') 
        ), 

        'grids' => array( 
                'type' => 'css', 
                'path' => 'grids/grids-min.css', 
                'requires' => array('fonts'), 
                'optional' => array('reset') 
        ), 

        'history' => array( 
                'type' => 'js', 
                'path' => 'history/history-min.js', 
                'requires' => array('event') 
        ), 

         'imagecropper' => array( 
                 'type' => 'js', 
                 'path' => 'imagecropper/imagecropper-min.js', 
                 'requires' => array('dom', 'event', 'dragdrop', 'element', 'resize'), 
                 'skinnable' => true 
         ), 

         'imageloader' => array( 
                'type' => 'js', 
                'path' => 'imageloader/imageloader-min.js', 
                'requires' => array('event', 'dom') 
         ), 

         'json' => array( 
                'type' => 'js', 
                'path' => 'json/json-min.js', 
                'requires' => array('yahoo') 
         ), 

         'layout' => array( 
                 'type' => 'js', 
                 'path' => 'layout/layout-min.js', 
                 'requires' => array('dom', 'event', 'element'), 
                 'optional' => array('animation', 'dragdrop', 'resize', 'selector'), 
                 'skinnable' => true 
         ), 

        'logger' => array( 
                'type' => 'js', 
                'path' => 'logger/logger-min.js', 
                'requires' => array('event', 'dom'), 
                'optional' => array('dragdrop'), 
                'skinnable' => true 
        ), 

        'menu' => array( 
                'type' => 'js', 
                'path' => 'menu/menu-min.js', 
                'requires' => array('containercore'), 
                'skinnable' => true 
        ), 

        'paginator' => array( 
                'type' => 'js', 
                'path' => 'paginator/paginator-min.js', 
                'requires' => array('element'), 
                'skinnable' => true 
        ), 

        'profiler' => array( 
                'type' => 'js', 
                'path' => 'profiler/profiler-min.js', 
                'requires' => array('yahoo') 
        ), 


        'profilerviewer' => array( 
                'type' => 'js', 
                'path' => 'profilerviewer/profilerviewer-min.js', 
                'requires' => array('profiler', 'yuiloader', 'element'), 
                'skinnable' => true 
        ), 

        'reset' => array( 
                'type' => 'css', 
                'path' => 'reset/reset-min.css' 
        ), 

        'reset-fonts-grids' => array( 
                'type' => 'css', 
                'path' => 'reset-fonts-grids/reset-fonts-grids.css', 
                'supersedes' => array('reset', 'fonts', 'grids', 'reset-fonts'), 
                'rollup' => 4 
        ), 

        'reset-fonts' => array( 
                'type' => 'css', 
                'path' => 'reset-fonts/reset-fonts.css', 
                'supersedes' => array('reset', 'fonts'), 
                'rollup' => 2 
        ), 

         'resize' => array( 
                 'type' => 'js', 
                 'path' => 'resize/resize-min.js', 
                 'requires' => array('dom', 'event', 'dragdrop', 'element'), 
                 'optional' => array('animation'), 
                 'skinnable' => true 
         ), 

        'selector' => array( 
                'type' => 'js', 
                'path' => 'selector/selector-min.js', 
                'requires' => array('yahoo', 'dom') 
        ), 

        'simpleeditor' => array( 
                'type' => 'js', 
                'path' => 'editor/simpleeditor-min.js', 
                'requires' => array('element'), 
                'optional' => array('containercore', 'menu', 'button', 'animation', 'dragdrop'), 
                'skinnable' => true, 
                'pkg' => 'editor' 
        ), 

        'slider' => array( 
                'type' => 'js', 
                'path' => 'slider/slider-min.js', 
                'requires' => array('dragdrop'), 
                'optional' => array('animation'), 
                'skinnable' => true 
        ), 

         'stylesheet' => array( 
                'type' => 'js', 
                'path' => 'stylesheet/stylesheet-min.js', 
                'requires' => array('yahoo') 
         ), 

        'tabview' => array( 
                'type' => 'js', 
                'path' => 'tabview/tabview-min.js', 
                'requires' => array('element'), 
                'optional' => array('connection'), 
                'skinnable' => true 
        ), 

        'treeview' => array( 
                'type' => 'js', 
                'path' => 'treeview/treeview-min.js', 
                'requires' => array('event', 'dom'), 
                'optional' => array('json'), 
                'skinnable' => true 
        ), 

        'uploader' => array( 
                'type' => 'js', 
                'path' => 'uploader/uploader.js', 
                'requires' => array('element') 
        ), 

        'utilities' => array( 
                'type' => 'js', 
                'path' => 'utilities/utilities.js', 
                'supersedes' => array('yahoo', 'event', 'dragdrop', 'animation', 'dom', 'connection', 'element', 'yahoo-dom-event', 'get', 'yuiloader', 'yuiloader-dom-event'), 
                'rollup' => 8 
        ), 

        'yahoo' => array( 
                'type' => 'js', 
                'path' => 'yahoo/yahoo-min.js' 
        ), 

        'yahoo-dom-event' => array( 
                'type' => 'js', 
                'path' => 'yahoo-dom-event/yahoo-dom-event.js', 
                'supersedes' => array('yahoo', 'event', 'dom'), 
                'rollup' => 3 
        ), 

        'yuiloader' => array( 
                'type' => 'js', 
                'path' => 'yuiloader/yuiloader-min.js', 
                'supersedes' => array('yahoo', 'get') 
        ), 

        'yuiloader-dom-event' => array( 
                'type' => 'js', 
                'path' => 'yuiloader-dom-event/yuiloader-dom-event.js', 
                'supersedes' => array('yahoo', 'dom', 'event', 'get', 'yuiloader', 'yahoo-dom-event'), 
                'rollup' => 5 
        ), 

        'yuitest' => array( 
                'type' => 'js', 
                'path' => 'yuitest/yuitest-min.js', 
                'requires' => array('logger'), 
                'skinnable' => true 
        ) 
); 


//
//
//$json = <<<EOF
//{
//	'moduleInfo': {
//		'animation': {
//		    'type': 'js',
//		    'path': 'animation/animation-min.js',
//		    'requires': ['dom', 'event']
//		},
//		
//		'autocomplete': {
//		    'type': 'js',
//		    'path': 'autocomplete/autocomplete-min.js',
//		    'requires': ['dom', 'event', 'datasource'],
//		    'optional': ['connection', 'animation'],
//		    'skinnable': true
//		},
//		
//		'base': {
//		    'type': 'css',
//		    'path': 'base/base-min.css',
//		    'after': ['reset', 'fonts', 'grids']
//		},
//		
//		'button': {
//		    'type': 'js',
//		    'path': 'button/button-min.js',
//		    'requires': ['element'],
//		    'optional': ['menu'],
//		    'skinnable': true
//		},
//		
//		'calendar': {
//		    'type': 'js',
//		    'path': 'calendar/calendar-min.js',
//		    'requires': ['event', 'dom'],
//		    supersedes: ['datemeth'],
//		    'skinnable': true
//		},
//		
//		'carousel': {
//		    'type': 'js',
//		    'path': 'carousel/carousel-min.js',
//		    'requires': ['element'],
//		    'optional': ['animation'],
//		    'skinnable': true
//		},
//		
//		'charts': {
//		    'type': 'js',
//		    'path': 'charts/charts-min.js',
//		    'requires': ['element', 'json', 'datasource', 'swf']
//		},
//		
//		'colorpicker': {
//		    'type': 'js',
//		    'path': 'colorpicker/colorpicker-min.js',
//		    'requires': ['slider', 'element'],
//		    'optional': ['animation'],
//		    'skinnable': true
//		},
//		
//		'connection': {
//		    'type': 'js',
//		    'path': 'connection/connection-min.js',
//		    'requires': ['event'],
//		    'supersedes': ['connectioncore']
//		},
//		
//		'connectioncore': {
//		    'type': 'js',
//		    'path': 'connection/connection_core-min.js',
//		    'requires': ['event'],
//		    'pkg': 'connection'
//		},
//		
//		'container': {
//		    'type': 'js',
//		    'path': 'container/container-min.js',
//		    'requires': ['dom', 'event'],
//		    // button is also optional, but this creates a circular 
//		    // dependency when loadOptional is specified.  button
//		    // optionally includes menu, menu requires container.
//		    'optional': ['dragdrop', 'animation', 'connection'],
//		    'supersedes': ['containercore'],
//		    'skinnable': true
//		},
//		
//		'containercore': {
//		    'type': 'js',
//		    'path': 'container/container_core-min.js',
//		    'requires': ['dom', 'event'],
//		    'pkg': 'container'
//		},
//		
//		'cookie': {
//		    'type': 'js',
//		    'path': 'cookie/cookie-min.js',
//		    'requires': ['yahoo']
//		},
//		
//		'datasource': {
//		    'type': 'js',
//		    'path': 'datasource/datasource-min.js',
//		    'requires': ['event'],
//		    'optional': ['connection']
//		},
//		
//		'datatable': {
//		    'type': 'js',
//		    'path': 'datatable/datatable-min.js',
//		    'requires': ['element', 'datasource'],
//		    'optional': ['calendar', 'dragdrop', 'paginator'],
//		    'skinnable': true
//		},
//		
//		datemath: {
//		    'type': 'js',
//		    'path': 'datemath/datemath-min.js',
//		    'requires': ['yahoo']
//		},
//		
//		'dom': {
//		    'type': 'js',
//		    'path': 'dom/dom-min.js',
//		    'requires': ['yahoo']
//		},
//		
//		'dragdrop': {
//		    'type': 'js',
//		    'path': 'dragdrop/dragdrop-min.js',
//		    'requires': ['dom', 'event']
//		},
//		
//		'editor': {
//		    'type': 'js',
//		    'path': 'editor/editor-min.js',
//		    'requires': ['menu', 'element', 'button'],
//		    'optional': ['animation', 'dragdrop'],
//		    'supersedes': ['simpleeditor'],
//		    'skinnable': true
//		},
//		
//		'element': {
//		    'type': 'js',
//		    'path': 'element/element-min.js',
//		    'requires': ['dom', 'event'],
//		    'optional': ['event-mouseenter', 'event-delegate']
//		},
//		
//		'element-delegate': {
//		    'type': 'js',
//		    'path': 'element-delegate/element-delegate-min.js',
//		    'requires': ['element']
//		},
//		
//		'event': {
//		    'type': 'js',
//		    'path': 'event/event-min.js',
//		    'requires': ['yahoo']
//		},
//		
//		'event-simulate': {
//		    'type': 'js',
//		    'path': 'event-simulate/event-simulate-min.js',
//		    'requires': ['event']
//		},
//		
//		'event-delegate': {
//		    'type': 'js',
//		    'path': 'event-delegate/event-delegate-min.js',
//		    'requires': ['event'],
//		    'optional': ['selector']
//		},
//		
//		'event-mouseenter': {
//		    'type': 'js',
//		    'path': 'event-mouseenter/event-mouseenter-min.js',
//		    'requires': ['dom', 'event']
//		},
//		
//		'fonts': {
//		    'type': 'css',
//		    'path': 'fonts/fonts-min.css'
//		},
//		
//		'get': {
//		    'type': 'js',
//		    'path': 'get/get-min.js',
//		    'requires': ['yahoo']
//		},
//		
//		'grids': {
//		    'type': 'css',
//		    'path': 'grids/grids-min.css',
//		    'requires': ['fonts'],
//		    'optional': ['reset']
//		},
//		
//		'history': {
//		    'type': 'js',
//		    'path': 'history/history-min.js',
//		    'requires': ['event']
//		},
//		
//		 'imagecropper': {
//		     'type': 'js',
//		     'path': 'imagecropper/imagecropper-min.js',
//		     'requires': ['dragdrop', 'element', 'resize'],
//		     'skinnable': true
//		 },
//		
//		 'imageloader': {
//		    'type': 'js',
//		    'path': 'imageloader/imageloader-min.js',
//		    'requires': ['event', 'dom']
//		 },
//		
//		 'json': {
//		    'type': 'js',
//		    'path': 'json/json-min.js',
//		    'requires': ['yahoo']
//		 },
//		
//		 'layout': {
//		     'type': 'js',
//		     'path': 'layout/layout-min.js',
//		     'requires': ['element'],
//		     'optional': ['animation', 'dragdrop', 'resize', 'selector'],
//		     'skinnable': true
//		 }, 
//		
//		'logger': {
//		    'type': 'js',
//		    'path': 'logger/logger-min.js',
//		    'requires': ['event', 'dom'],
//		    'optional': ['dragdrop'],
//		    'skinnable': true
//		},
//		
//		'menu': {
//		    'type': 'js',
//		    'path': 'menu/menu-min.js',
//		    'requires': ['containercore'],
//		    'skinnable': true
//		},
//		
//		'paginator': {
//		    'type': 'js',
//		    'path': 'paginator/paginator-min.js',
//		    'requires': ['element'],
//		    'skinnable': true
//		},
//		
//		'profiler': {
//		    'type': 'js',
//		    'path': 'profiler/profiler-min.js',
//		    'requires': ['yahoo']
//		},
//		
//		
//		'profilerviewer': {
//		    'type': 'js',
//		    'path': 'profilerviewer/profilerviewer-min.js',
//		    'requires': ['profiler', 'yuiloader', 'element'],
//		    'skinnable': true
//		},
//		
//		'progressbar': {
//		    'type': 'js',
//		    'path': 'progressbar/progressbar-min.js',
//		    'requires': ['element'],
//		    'optional': ['animation'],
//		    'skinnable': true
//		},
//		
//		'reset': {
//		    'type': 'css',
//		    'path': 'reset/reset-min.css'
//		},
//		
//		'reset-fonts-grids': {
//		    'type': 'css',
//		    'path': 'reset-fonts-grids/reset-fonts-grids.css',
//		    'supersedes': ['reset', 'fonts', 'grids', 'reset-fonts'],
//		    'rollup': 4
//		},
//		
//		'reset-fonts': {
//		    'type': 'css',
//		    'path': 'reset-fonts/reset-fonts.css',
//		    'supersedes': ['reset', 'fonts'],
//		    'rollup': 2
//		},
//		
//		 'resize': {
//		     'type': 'js',
//		     'path': 'resize/resize-min.js',
//		     'requires': ['dragdrop', 'element'],
//		     'optional': ['animation'],
//		     'skinnable': true
//		 },
//		
//		'selector': {
//		    'type': 'js',
//		    'path': 'selector/selector-min.js',
//		    'requires': ['yahoo', 'dom']
//		},
//		
//		'simpleeditor': {
//		    'type': 'js',
//		    'path': 'editor/simpleeditor-min.js',
//		    'requires': ['element'],
//		    'optional': ['containercore', 'menu', 'button', 'animation', 'dragdrop'],
//		    'skinnable': true,
//		    'pkg': 'editor'
//		},
//		
//		'slider': {
//		    'type': 'js',
//		    'path': 'slider/slider-min.js',
//		    'requires': ['dragdrop'],
//		    'optional': ['animation'],
//		    'skinnable': true
//		},
//		
//		'storage': {
//		    'type': 'js',
//		    'path': 'storage/storage-min.js',
//		    'requires': ['yahoo', 'event', 'cookie'],
//		    'optional': ['swfstore']
//		},
//		
//		 'stylesheet': {
//		    'type': 'js',
//		    'path': 'stylesheet/stylesheet-min.js',
//		    'requires': ['yahoo']
//		 },
//		
//		'swf': {
//		    'type': 'js',
//		    'path': 'swf/swf-min.js',
//		    'requires': ['element'],
//		    'supersedes': ['swfdetect']
//		},
//		
//		'swfdetect': {
//		    'type': 'js',
//		    'path': 'swfdetect/swfdetect-min.js',
//		    'requires': ['yahoo']
//		},
//		
//		'swfstore': {
//		    'type': 'js',
//		    'path': 'swfstore/swfstore-min.js',
//		    'requires': ['element', 'cookie', 'swf']
//		},
//		
//		'tabview': {
//		    'type': 'js',
//		    'path': 'tabview/tabview-min.js',
//		    'requires': ['element'],
//		    'optional': ['connection'],
//		    'skinnable': true
//		},
//		
//		'treeview': {
//		    'type': 'js',
//		    'path': 'treeview/treeview-min.js',
//		    'requires': ['event', 'dom'],
//		    'optional': ['json', 'animation', 'calendar'],
//		    'skinnable': true
//		},
//		
//		'uploader': {
//		    'type': 'js',
//		    'path': 'uploader/uploader-min.js',
//		    'requires': ['element']
//		},
//		
//		'utilities': {
//		    'type': 'js',
//		    'path': 'utilities/utilities.js',
//		    'supersedes': ['yahoo', 'event', 'dragdrop', 'animation', 'dom', 'connection', 'element', 'yahoo-dom-event', 'get', 'yuiloader', 'yuiloader-dom-event'],
//		    'rollup': 8
//		},
//		
//		'yahoo': {
//		    'type': 'js',
//		    'path': 'yahoo/yahoo-min.js'
//		},
//		
//		'yahoo-dom-event': {
//		    'type': 'js',
//		    'path': 'yahoo-dom-event/yahoo-dom-event.js',
//		    'supersedes': ['yahoo', 'event', 'dom'],
//		    'rollup': 3
//		},
//		
//		'yuiloader': {
//		    'type': 'js',
//		    'path': 'yuiloader/yuiloader-min.js',
//		    'supersedes': ['yahoo', 'get']
//		},
//		
//		'yuiloader-dom-event': {
//		    'type': 'js',
//		    'path': 'yuiloader-dom-event/yuiloader-dom-event.js',
//		    'supersedes': ['yahoo', 'dom', 'event', 'get', 'yuiloader', 'yahoo-dom-event'],
//		    'rollup': 5
//		},
//		
//		'yuitest': {
//		    'type': 'js',
//		    'path': 'yuitest/yuitest-min.js',
//		    'requires': ['logger'],
//		    'optional': ['event-simulate'],
//		    'skinnable': true
//		}
//	}
//}
//EOF;


?>