<div id='wrapped_content'>  
    <div id="ar_left">
        <?php $form=$this->beginWidget('CActiveForm',array(
            'id'=>'searchform',
            'enableAjaxValidation'=>false,
        )); ?>
        
            <div id='search_form_container'>
                <input type="text" name="q" id="q" value="<?php echo isset($query)? $query : "" ?>"/>
                <input type="submit" name="s" id="s" value=""/>
            </div>
            <div id="search_form_description">
                Search from indexed document
            </div>
            <div id="search_logo">
            </div>
            <div id="search_text">
                SearchD
            </div>
         <?php
             $this->endWidget(); 
         ?>
        
        <div id="search_retype_query" style="max-width: 500px">
            <?php echo isset($query)? "<i>Search result for : </i> " . $query : "" ?>
            <?php echo isset($query)? "<br/><i>Get results in : </i> " . $time . " seconds." : "" ?>
        </div>
        
        <div id="search_result_container">
            <?php if(isset($result) && count($result)> 0): ?>
            <?php foreach($result as $doc): ?>
            <div class="search_result">
                <div class="sign"></div>
                <div class="title">
                    <a href="<?= $doc['url']; ?>" target="_blank"><?= $doc['title']; ?></a>
                </div>
                <div class="author">
                    Author : <?= $doc['author']; ?>
                </div>
                <div class="content">
                    <?= $doc['content']; ?>
                </div>
            </div>
            <?php endforeach; ?>
            <br/>
            <br/>
            <?php endif; ?>
        </div>
    </div>
    
    
    <div id="ar_right"
         <?php echo ((isset($debug) && $debug == false) || !isset($debug)) ? "style='display:none;'" : ""; ?>
    >
        <div id="option_bg">
            <?php if(isset($debug)): ?>
            <div class="debug_title">
                Words
            </div>
            <div class="debug_content">
                <?php foreach($words as $key => $value): ?>
                    <div><?php echo $key . "(docs: ". $value['docs'] .", hits: " . $value['hits'] .")" ; ?></div>
                <?php endforeach; ?>
            </div>
            <div class="debug_title">
                Total
            </div>
            <div class="debug_content">
                <?php print_r($total); ?>
            </div>
            <div class="debug_title">
                Total Found
            </div>
            <div class="debug_content">
                <?php print_r($total_found); ?>
            </div>
             <div class="debug_title">
                Status
            </div>
            <div class="debug_content">
                <?php print_r($status); ?>
            </div>
            <div class="debug_title">
                Warning
            </div>
            <div class="debug_content">
                <?php print_r($warning); ?>
            </div>
            <div class="debug_title">
                Error
            </div>
            <div class="debug_content">
                <?php print_r($error); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
    
</div>