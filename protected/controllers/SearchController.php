<?php

class SearchController extends Controller
{
	public $moduleName = 'Search';
    public $layout = '//layouts/search';
	
	public function actionIndex()
	{
        if(isset($_POST['q']) && strlen($_POST['q']) > 0)
        {
            $keyword = $_POST['q'];
            
            $debug = strpos($keyword, "--debug")? true : false;
            
            if($debug)
            {
                $keyword = preg_replace("/--debug/", "", $keyword);
            }

            $results = $this->sphinxSearch($keyword);

            $error = isset($results['error'])? $results['error'] : "-";
            $warning =  isset($results['warning'])? $results['warning'] : "-";
            $status = isset($results['status'])? $results['status'] : "-";
            $total = isset($results['total'])? $results['total'] : "-";
            $total_found = isset($results['total_found'])? $results['total_found'] : "-";
            $time = isset($results['time'])? $results['time'] : "-";
            $words = isset($results['words'])? $results['words'] : "-";
            $matches = isset($results['matches'])? $results['matches'] : "-";

            $result = array();

            if(isset($results['matches']))
            {
                $ids = $this->extractIds($results['matches']);
                $result = $this->getDocumentsByIds($ids);
            }
            
            $this->render('index', array(
                'error' => $error, 
                'warning' => $warning,
                'status' => $status,
                'total' => $total,
                'total_found' => $total_found,
                'time' => $time,
                'words' => $words,
                'result' => $result,
                'query' => $keyword,
                'debug' => $debug,
                'matches' => $matches
                )
            );
        }
        else
        {
            $this->render('index');
        }
	}
    
    private function sphinxSearch($keyword)
    {
        $sp = new SphinxClient();
        $sp->SetServer(SphinxConf::$IP, SphinxConf::$PORT);
        $sp->SetLimits(0, SphinxConf::$LIMIT);
        $sp->SetMatchMode(SPH_MATCH_ALL);
        $sp->SetSortMode(SPH_SORT_RELEVANCE);

        return $sp->Query($keyword);
    }
    
    private function extractIds($arrMatches)
    {
        if(!(count($arrMatches) > 0)) return false;
        
        $result = array();
        
        foreach($arrMatches as $doc)
        {
            $result[] = (int) $doc['attrs']['id'];
        }
        
        return $result;
    }
    
    private function getDocumentsByIds($arrIds)
    {
        if(!(count($arrIds) > 0)) return false;

        $filePath = Yii::app()->basePath . '/../files/korpus/korpuss.xml';
        $handle = simplexml_load_file($filePath);
        
        $arrResult = array();
        
        foreach ($handle->document as $doc) 
        {
            if(in_array($doc->id , $arrIds))
            {
                $result = array();
                $result['id'] = (string) $doc->id;
                $result['title'] = (string)  $doc->title;
                $result['author'] = (string) $doc->author;
                $result['content'] = (string) $this->truncate($doc->content, 170);
                $result['url'] = (string) $doc->url;
                
                $arrResult[] = $result;
            }
        }
        
        return $arrResult;
    }
    
    //truncate a string only at a whitespace (by nogdog)
    private function truncate($text, $length) 
    {
        $length = abs((int)$length);
        
        if(strlen($text) > $length) 
        {
            $text = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...', $text);
        }
        
        return($text);
    }
}