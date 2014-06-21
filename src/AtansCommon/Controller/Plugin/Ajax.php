<?php
namespace AtansCommon\Controller\Plugin;

use Zend\Http\Response;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\View\Model\JsonModel;

class Ajax extends AbstractPlugin
{
    const CONTENT_TYPE_HTML       = 'text/html; charset=%s';
    const CONTENT_TYPE_TEXT_PLAIN = 'text/plain; charset=%s';
    const CONTENT_TYPE_JSON       = "application/json; charset=%s";

    const ENCODING = 'utf-8';

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
     * Returns Ajax
     *
     * @param  bool $noCache
     * @return Ajax
     */
    public function __invoke($noCache = true)
    {
        $this->noCache = $noCache;

        return $this;
    }

    /**
     * Response html
     *
     * @param  string $html
     * @param  string $encoding
     * @return Response
     */
    public function html($html, $encoding = self::ENCODING)
    {
        return $this->response($html, sprintf(self::CONTENT_TYPE_HTML, $encoding));
    }

    /**
     * Returns Response
     *
     * @param  string $text
     * @param  string $encoding
     * @return Response
     */
    public function text($text, $encoding = self::ENCODING)
    {
        return $this->response($text, sprintf(self::CONTENT_TYPE_TEXT_PLAIN, $encoding));
    }

    /**
     * Returns status JsonModel
     *
     * @param string            $status
     * @param null|array|string $message
     * @param array             $data
     * @return JsonModel
     */
    public function status($status, $message = null, array $data = null)
    {
        return $this->jsonCallback(static::TYPE_STATUS, $status, $message, $data);
    }

    /**
     * Returns success JsonModel
     *
     * @param bool              $status
     * @param null|array|string $message
     * @param array             $data
     * @return JsonModel
     */
    public function success($status, $message = null, array $data = null)
    {
        return $this->jsonCallback(static::TYPE_SUCCESS, $status, $message, $data);
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
    public function jsonCallback($type, $typeValue, $message = null, array $data = null)
    {
        if ($this->noCache) {
            $this->noCache();
        }

        $this->getJsonModel()->setVariable($type, $typeValue);

        if (!is_null($message)) {
            if (is_array($message)) {
                $this->setData($type, $message);
            } elseif (is_string($message)) {
                $this->getJsonModel()->setVariable(static::KEY_MESSAGE, $message);
            }
        }
        $this->setData($type, $data);

        $jsonModel = $this->getJsonModel();

        // Reset JsonModel
        $this->jsonModel = null;
        $this->getResponse()->getHeaders()->addHeaderLine('Content-Type', sprintf(self::CONTENT_TYPE_JSON, self::ENCODING));

        return $jsonModel;
    }

    /**
     * Set data
     *
     * @param  string $type
     * @param  array $data
     * @return Ajax
     */
    public function setData($type, $data)
    {
        if (!is_null($data) && is_array($data) && count($data) > 0) {
            $jsonModel = $this->getJsonModel();
            foreach ($data as $key => $value) {
                // Skip key is (status, success), message is not a null value
                if (
                    in_array($key, array($type)) ||
                    $key === static::KEY_MESSAGE && !is_null($jsonModel->getVariable(static::KEY_MESSAGE, null))
                ) {
                    continue;
                }
                $jsonModel->setVariable($key, $value);
            }
        }
        return $this;
    }

    /**
     * Set response content
     *
     * @param  string $content
     * @param  string $contentType
     * @return Ajax
     */
    public function response($content, $contentType)
    {
        if ($this->noCache) {
            $this->noCache();
        }

        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine('Content-Type', $contentType);
        $response->setContent($content);

        return $response;
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
    public function noCache()
    {
        $headers = $this->getResponse()->getHeaders();
        $headers->addHeaders(array(
            'Cache-Control' => 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0',
            'Expires'       => 'Thu, 19 Nov 1981 08:52:00 GMT',
            'Pragma'        => 'no-cache',
        ));
    }
}
