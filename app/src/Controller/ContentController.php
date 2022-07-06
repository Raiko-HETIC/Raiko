<?php

namespace App\Controller;

use App\Factory\PDOFactory;
use App\Model\ContentModel;
use App\HTTP\HTTPRequest;

class ContentController extends BaseController
{
    // All Exercices & Ambiances
    public function executeExerciceList()
    {
        $contentModel = new ContentModel(new PDOFactory());
        $exercices = $contentModel->getAllExercice();
        $this->renderJSON($exercices);
    }

    public function executeAmbianceList()
    {
        $contentModel = new ContentModel(new PDOFactory());
        $ambiance = $contentModel->getAllAmbiance();
        $this->renderJSON($ambiance);
    }

    // Detailled view
    public function executeExerciceById (int $id = 1) {
        $contentModel = new ContentModel(new PDOFactory());
        $exercice = $contentModel->getExerciceById($id);
    }

    /*
    public function executeContent(int $id = 1)
    {
        $categoryModel = new ContentModel(new PDOFactory());
        $category = $categoryModel->getAllCategory();
        $this->renderJSON($category);
    }
    */
}