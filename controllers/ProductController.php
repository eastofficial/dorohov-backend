<?php

class ProductController
{
    
    public function actionList()
    {
        require_once(ROOT . 'views/product/view.php');

        return true;
    }
    
}
