<?php

class NewsController    
{
    
    public function actionIndex()
    {
        echo "Список новостей";
        return true;
    }

    
    public function actionView($category, $id)
    {
        
        echo "Просмотр 1 новости";
        return true;
    }

}
