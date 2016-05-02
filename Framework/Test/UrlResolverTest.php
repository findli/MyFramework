<?php
/**
 * Created by PhpStorm.
 * User: Ya
 * Date: 12/14/2015
 * Time: 6:04 PM
 */

namespace framework\Test;

use Framework\Request;

require_once '../../autoload.php';

class RequestTest extends \PHPUnit_Framework_TestCase
{
    function testGet()
    {

        $_GET['test'] = 'testValue';

        $request = new \framework\Request();

        $this->assertEquals(
            $request->getGet('test'),
            'testValue',
            '$_GET[\'test\'] = testValue !== (new \framework\Request())->getGet(\'test\')' . __METHOD__
        );
    }

    function testPost()
    {

        $_POST['test'] = 'testValue';

        $request = new \framework\Request();

        $this->assertEquals(
            $request->getPost('test'),
            'testValue',
            '$_POST[\'test\'] = testValue !== (new \framework\Request())->getPost(\'test\')' . __METHOD__
        );
    }

    function testParam()
    {

        $_GET['testGET']   = 'testValue';
        $_POST['testPOST'] = 'testValue';

        $request = new \framework\Request();

        $this->assertEquals(
            $request->getParam('testGET'),
            'testValue',
            '$_GET[\'test\'] = testValue !== (new \framework\Request())->getParam(\'testGET\')' . __METHOD__
        );
        $this->assertEquals(
            $request->getParam('testPOST'),
            'testValue',
            '$_POST[\'testPOST\'] = testValue !== (new \framework\Request())->getParam(\'testPOST\')' . __METHOD__
        );
    }

    function testParams()
    {

        $_GET['testGET']   = 'testValue';
        $_POST['testPOST'] = 'testValue';

        $request = new \framework\Request();

        $this->assertEquals(
            $request->getParam('testGET'),
            'testValue',
            '$_GET[\'test\'] = testValue !== (new \framework\Request())->getParam(\'testGET\')' . __METHOD__
        );
        $this->assertEquals(
            $request->getParam('testPOST'),
            'testValue',
            '$_POST[\'testPOST\'] = testValue !== (new \framework\Request())->getParam(\'testPOST\')' . __METHOD__
        );
    }

    function testGetParamsByRequestTypeController()
    {
        $request = new Request();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET                      = [
            'tGET1' => 'tGET1Value',
            'tGET2' => 'tGET2Value'
        ];
        $this->assertEquals(
            $request->getParamsByRequestType(),
            $_GET
        );

        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST                     = [
            'tPOST1' => 'tPOST1Value',
            'tPOST2' => 'tPOST2Value'
        ];
        $this->assertEquals(
            $request->getParamsByRequestType(),
            $_POST
        );
    }

    function testGetController()
    {
        $request                = new Request();
        $cName                  = '/controller-name';
        $_SERVER['REQUEST_URI'] = $cName;
        $this->assertEquals(
            Request::getControllerName(),
            'controller-name'
        );
    }

    function testGetControllerClass()
    {
        $request                = new Request();
        $cName                  = '/controller-name';
        $_SERVER['REQUEST_URI'] = $cName;
        $this->assertEquals(
            $request->getControllerClassName(),
            '\controller\\' . 'controller-name' . 'Controller'
        );

        $cName                  = '/';
        $_SERVER['REQUEST_URI'] = $cName;
        $this->assertEquals(
            $request->getControllerClassName(),
            '\controller\\' . '' . 'Controller'
        );
    }

    function testGetAction()
    {
        $request                = new Request();
        $cName                  = '/controller-name/action-name';
        $_SERVER['REQUEST_URI'] = $cName;
        $this->assertEquals(
            $request->getActionName(),
            'action-name'
        );

        $cName                  = '/controller-name/';
        $_SERVER['REQUEST_URI'] = $cName;
        $this->assertEquals(
            $request->getActionName(),
            ''
        );

        $cName                  = '//action-name';
        $_SERVER['REQUEST_URI'] = $cName;
        $this->assertEquals(
            $request->getActionName(),
            'action-name'
        );
    }
}