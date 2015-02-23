<?php

class KorpusController extends CoreController
{
	public $moduleName = 'Korpus';
	
	public function actionIndex()
	{
		$this->redirect(array('korpus/uploadFile'));
	}
	
	public function actionUploadFile()
    {
        $model = new FormKorpus();
        
        if(isset($_POST['FormKorpus']))
        {
            $model->attributes = $_POST['FormKorpus'];
            $file = CUploadedFile::getInstance($model, 'file');
            
            if($model->validate())
            {
                if($file != null)
                {
                    $filePath = Yii::app()->basePath . '/../files/korpus/korpus.xml';
                    $file->saveAs($filePath);
					
					Yii::app()->user->setFlash('success', 'Success, korpus file uploaded!');
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