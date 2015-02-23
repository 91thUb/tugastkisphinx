<?php

class StopWordController extends CoreController
{
    public $moduleName = 'Stop Word';
    
	public function actionIndex()
	{
		$this->redirect(array('stopWord/uploadFile'));
	}
    
   public function actionUploadFile()
    {
        $model = new FormStopWord();
        
        if(isset($_POST['FormStopWord']))
        {
            $model->attributes = $_POST['FormStopWord'];
            $file = CUploadedFile::getInstance($model, 'file');
            
            if($model->validate())
            {
                if($file != null)
                {
                    $filePath = Yii::app()->basePath . '/../files/stopword/stopword.txt';
                    $file->saveAs($filePath);
					
					Yii::app()->user->setFlash('success', 'Success, stop word file uploaded!');
                }
                else
                {
                    Yii::app()->user->setFlash('error', 'Error, please try again');
                }
            }
        }
		
		$this->render('index',array(
            'model' => $model
		));
	}
	
}
