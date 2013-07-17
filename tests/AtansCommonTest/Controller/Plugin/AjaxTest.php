<?php
namespace AtansCommonTest\Controller\Plugin;

use AtansCommon\Controller\Plugin\Ajax;
use PHPUnit_Framework_TestCase;
use Zend\Http\Response;
use Zend\View\Model\JsonModel;
use Zend\View\Renderer\JsonRenderer;

class AjaxTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Ajax
     */
    protected $ajax;

    /**
     * @var JsonRenderer
     */
    protected $jsonRenderer;

    public function setUp()
    {
        $this->ajax = new Ajax();
        $this->ajax->setResponse(new Response());
        $this->jsonRenderer = new JsonRenderer();
    }

    public function testText()
    {
        $response = new Response();
        $response->setContent('Text');
        $this->assertSame(
            $this->ajax->text('Text')->getContent(),
            $response->getContent(),
            'Text output'
        );
    }

    public function testStatus()
    {
        $testStatus = new JsonModel(array(
            'status' => 'ok',
        ));
        $this->assertSame(
            $this->jsonRenderer->render($testStatus),
            $this->jsonRenderer->render($this->ajax->status('ok')),
            'Test status'
        );

        $testMessage = new JsonModel(array(
            'status'  => 'ok',
            'message' => 'Message',
        ));
        $this->assertSame(
            $this->jsonRenderer->render($testMessage),
            $this->jsonRenderer->render($this->ajax->status('ok', 'Message')),
            'Test status message'
        );

        $testData = new JsonModel(array(
            'status'  => 'ok',
            'message' => 'Message',
            'data'    => 'data',
        ));
        $this->assertSame(
            $this->jsonRenderer->render($testData),
            $this->jsonRenderer->render($this->ajax->status('ok', 'Message', array('data' => 'data'))),
            'Test status data'
        );

        $testArrayMessage = new JsonModel(array(
            'status'  => 'ok',
            'data'    => 'data',
        ));
        $this->assertSame(
            $this->jsonRenderer->render($testArrayMessage),
            $this->jsonRenderer->render($this->ajax->status('ok', array('data' => 'data'))),
            'Test array message'
        );

        $testUndifinedMessage = new JsonModel(array(
            'status' => 'ok',
            'message' => 'Message2',
            'data'    => 'data',
        ));
        $this->assertSame(
            $this->jsonRenderer->render($testUndifinedMessage),
            $this->jsonRenderer->render($this->ajax->status('ok', array('message' => 'Message2', 'data' => 'data'))),
            'Test status undefined message'
        );

        $testDuplicateMessage = new JsonModel(array(
            'status' => 'ok',
            'message' => 'Message',
            'data'    => 'data',
        ));
        $this->assertSame(
            $this->jsonRenderer->render($testDuplicateMessage),
            $this->jsonRenderer->render($this->ajax->status('ok', 'Message', array('message' => 'Message2', 'data' => 'data'))),
            'Test status array message'
        );
    }

    public function testSuccess()
    {
        $testSuccess = new JsonModel(array(
            'success' => true,
        ));
        $this->assertSame(
            $this->jsonRenderer->render($testSuccess),
            $this->jsonRenderer->render($this->ajax->success(true)),
            'Test success'
        );

        $testMessage = new JsonModel(array(
            'success' => true,
            'message' => 'Message',
        ));
        $this->assertSame(
            $this->jsonRenderer->render($testMessage),
            $this->jsonRenderer->render($this->ajax->success(true, 'Message')),
            'Test success message'
        );

        $testData = new JsonModel(array(
            'success' => true,
            'message' => 'Message',
            'data'    => 'data',
        ));
        $this->assertSame(
            $this->jsonRenderer->render($testData),
            $this->jsonRenderer->render($this->ajax->success(true, 'Message', array('data' => 'data'))),
            'Test success data'
        );

        $testArrayMessage = new JsonModel(array(
            'success' => true,
            'data'    => 'data',
        ));
        $this->assertSame(
            $this->jsonRenderer->render($testArrayMessage),
            $this->jsonRenderer->render($this->ajax->success(true, array('data' => 'data'))),
            'Test success data'
        );

        $testUndifinedMessage = new JsonModel(array(
            'success' => true,
            'message' => 'Message2',
            'data'    => 'data',
        ));
        $this->assertSame(
            $this->jsonRenderer->render($testUndifinedMessage),
            $this->jsonRenderer->render($this->ajax->success(true, array('message' => 'Message2', 'data' => 'data'))),
            'Test success undefined message'
        );

        $testDuplicateMessage = new JsonModel(array(
            'success' => true,
            'message' => 'Message',
            'data'    => 'data',
        ));
        $this->assertSame(
            $this->jsonRenderer->render($testDuplicateMessage),
            $this->jsonRenderer->render($this->ajax->success(true, 'Message', array('message' => 'Message2', 'data' => 'data'))),
            'Test success array message'
        );
    }
}
