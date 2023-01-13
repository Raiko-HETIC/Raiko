<?php

namespace App\Controller;

use App\Factory\PDOFactory;
use App\Model\CategoryModel;

class CategoryController extends BaseController
{
    /**
     * Show all Category
     */
    public function executeIndex()
    {
        if ($this->HTTPRequest->isMethodAllowed('GET'))
        {
            $categoryModel = new CategoryModel(new PDOFactory());
            $category = $categoryModel->getAllCategory();
            return $this->renderJSON($category);
        }
    }
}