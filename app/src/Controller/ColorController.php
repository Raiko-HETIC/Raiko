<?php

namespace App\Controller;


class ColorController extends BaseController
{
    /**
     * Color
     */
    public function executeColor()
    {
        $response = $this->HTTPRequest->getBody();
        if (is_string($response)) {
            $this->renderJSON($response);
        } else {
            //Récupération des valeurs
            $colorHexadecimal = $response['colorHexadecimal'];

            if (!$colorHexadecimal) {
                http_response_code(404);
                $this->renderJSON("Color not found");
            } else {
                http_response_code(200);
                $this->renderJSON("$colorHexadecimal");
            }
        }
    }
}