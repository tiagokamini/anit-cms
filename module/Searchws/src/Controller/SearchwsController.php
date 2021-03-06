<?php

namespace Searchws\Controller;

use Searchws\Model\Searchdao;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use ExtLib\MCrypt;

/**
 * Class SearchwsController
 * @package Searchws\Controller
 */
class SearchwsController extends AbstractActionController
{
    /**
     * Content-Type accepted :
     * application/json and x-www-form-urlencoded
     * @return JsonModel
     */
    public function getpublicpagesAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $words = $this->getParams($request);
            $searchDao = new Searchdao();
            $occurences = $searchDao->getPublicPages($words, 'public');
            return new JsonModel(array(
                'results' => $occurences
            ));
        } else {
            $error = $this->translator->translate('Ce n\'est pas une requête POST');
            $this->response->setStatusCode(500);
            return new JsonModel(array(
                'error' => $error
            ));
        }
    }

    /**
     * Content-Type accepted :
     * application/json and x-www-form-urlencoded
     * @return JsonModel
     */
    public function getallpagesAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $words = $this->getParams($request);
            $searchDao = new Searchdao();
            $occurences = $searchDao->getAllPages($words, 'public');

            return new JsonModel(array(
                'results' => $occurences
            ));
        } else {
            $error = $this->translator->translate('Ce n\'est pas une requête POST');
            $this->response->setStatusCode(500);
            return new JsonModel(array(
                'error' => $error
            ));
        }
    }

    // TODO test line 67 to 69
    /**
     * Content-Type accepted :
     * application/json and x-www-form-urlencoded
     * @return JsonModel
     */
    public function getprivatepagesAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $loginaccess = new \Zend\Session\Container('myacl');
            $mcrypt = new MCrypt();
            $sessionData = json_decode($mcrypt->decrypt($loginaccess->userdata));
            $words = $this->getParams($request);
            $searchDao = new Searchdao();
            $occurences = $searchDao->getPrivatePages($words, $sessionData->spaceId);

            return new JsonModel(array(
                'results' => $occurences
            ));
        } else {
            $error = $this->translator->translate('Ce n\'est pas une requête POST');
            $this->response->setStatusCode(500);
            return new JsonModel(array(
                'error' => $error
            ));
        }
    }

    /**
     * @param $request
     * @return string
     */
    private function getParams($request)
    {
        $headers = $request->getHeaders();
        $accept = $headers->get('Content-Type');
        $params = "";
        $isJson = $accept->match('application/json');
        // $isUrlencoded = $accept->match('application/x-www-form-urlencoded');
        if ($isJson) {
            $content = $request->getContent();
            $content = str_replace("'", "\"", $content);
            $jsonDecode = json_decode($content, true);
            $params = $jsonDecode['search'];
        } else {
            $params = $request->getPost('search');
        }

        return $params;
    }
}
