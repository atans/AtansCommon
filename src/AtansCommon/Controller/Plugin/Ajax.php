<?php
namespace AtansCommon\Controller\Plugin;

use Zend\Http\Response;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\View\Model\JsonModel;

class Ajax extends AbstractPlugin
{
    const TYPE_STATUS  = 'status';
    const TYPE_SUCCESS = 'success';
    const KEY_MESSAGE  = 'message';

    /**
     * @var bool
     */
    protected $noCache = true;

    /**
     * @var JsonModel
     */
    protected $jsonModel;

    /**
     * @var Response
     */
    protected $response;

    /**
     * Returns $this
     *
     * @param  bool $noCache
     * @return JsonCallback
     */
    public function __invoke($noCache = true)
    {
        $this->noCache = $noCache;

        return $this;
    }

    /**
     * Returns Response
     *
     * @param  string $text
     * @return Response
     */
    public function text($text)
    {
        if ($this->noCache) {
            $this->noCache();
        }

        $response = $this->getResponse();
        $response->setContent($text);

        return $response;
    }

    /**
     * Returns status JsonModel
     *
     * @param string            $status
     * @param null|array|string $message
     * @param array             $data
     * @return JsonModel
     */
    public function status($status, $message = null, $data = null)
    {
        return $this->callback(static::TYPE_STATUS, $status, $message, $data);
    }

    /**
     * Returns success JsonModel
     *
     * @param bool              $status
     * @param null|array|string $message
     * @param array             $data
     * @return JsonModel
     */
    public function success($status, $message = null, $data = null)
    {
        return $this->callback(static::TYPE_SUCCESS, $status, $message, $data);
    }

    /**
     * Return JsonModel
     *
     * @param  string            $type
     * @param  string            $typeValue
     * @param  null|array|string $message
     * @param  array             $data
     * @return JsonModel
     */
    public function callback($type, $typeValue, $message = null, array $data = null)
    {
        if ($this->noCache) {
            $this->noCache();
        }

        $this->getJsonModel()->setVariable($type, $typeValue);
        if ($message !== null) {
            if (is_array($message)) {
                $this->setData($message);
            } elseif (is_string($message)) {
                $this->getJsonModel()->setVariable(static::KEY_MESSAGE, $message);
            }
        }
        $this->setData($data);

        return $this->getJsonModel();
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData($data)
    {
        if ($data !== null && is_array($data) && count($data) > 0) {
            foreach ($data as $key => $value) {
                if (!in_array($key, array(static::TYPE_STATUS, static::TYPE_SUCCESS, static::KEY_MESSAGE))) {
                    $this->getJsonModel()->setVariable($key, $value);
                }
            }
        }
        return $this;
    }

    /**
     * Get jsonModel
     *
     * @return JsonModel
     */
    public function getJsonModel()
    {
        if (!$this->jsonModel instanceof JsonModel) {
            $this->setJsonModel(new JsonModel());
        }
        return $this->jsonModel;
    }

    /**
     * Set jsonModel
     *
     * @param JsonModel $jsonModel
     * @return $this
     */
    public function setJsonModel(JsonModel $jsonModel)
    {
        $this->jsonModel = $jsonModel;
        return $this;
    }

    /**
     * Get response
     *
     * @return Response
     */
    public function getResponse()
    {
        if (!$this->response instanceof Response) {
            $this->setResponse($this->getController()->getResponse());
        }
        return $this->response;
    }

    /**
     * Set response
     *
     * @param Response $response
     * @return $this
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
        return $this;
    }

    /**
     * No cache header
     */
    protected function noCache()
    {
        $headers = $this->getResponse()->getHeaders();
        $headers->addHeaders(array(
            'Expires'       => 'Mon, 26 Jul 1997 05:00:00 GMT',
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
            'Pragma'        => 'no-cache',

        ));
    }
}
