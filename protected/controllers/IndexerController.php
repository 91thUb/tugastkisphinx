<?php

class IndexerController extends CoreController
{
	public $moduleName = 'Indexer';
	
	public function actionIndex()
	{
        $exec = exec("indexer --all", $out);
        
        print_r($out);
        
        die();
		$this->render('index');
	}
}