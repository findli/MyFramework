<?php
namespace CV\Controller;

use Framework\Controller;

class UserController extends Controller
{
    public function actionIndex()
    {
        $this->render('user/index');
    }
}