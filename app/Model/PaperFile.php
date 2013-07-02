<?php
	App::uses('AuthComponent', 'Controller/Component');

    class PaperFile extends AppModel {
        public $name = 'PaperFile';
        public $belongsTo = 'Paper';

	    var $actsAs = array( 
	    	'Upload.Upload' => array( 
	    		'file' => array( 
	    			'fields' => array( 
	    				'dir' => 'photo_dir' 
	    			), 
	    			'thumbsizes' => array( 
	    				'80x80' => '80x80', 
	    				'1280x768' => '1280x768'
	    			), 
	    			'thumbnailMethod'	=> 'php', 
	    		) 
	    	) 
	    );
    }
?>