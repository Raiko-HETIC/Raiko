<?php

namespace App\Controller;

use App\Factory\PDOFactory;
use App\Model\CategoryModel;


class HealthController extends BaseController
{
    public function executeHealthCheck()
    {
        if ($this->HTTPRequest->isMethodAllowed('GET'))
        {
            // Check if database is up
            try {
                $categoryModel = new CategoryModel(new PDOFactory());
                $category = $categoryModel->getAllCategory();
                return $this->renderJSON(['healthCheck' => 'OK']);
            }  
            catch (\Exception $e) {
                http_response_code(500);
                return $this->renderJSON(['healthCheck' => 'KO']);
            }
        }
    }
}