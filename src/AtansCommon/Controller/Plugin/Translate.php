<?php
namespace AtansCommon\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Mvc\I18n\Translator;

class Translate extends AbstractPlugin
{
    /**
     * @var Translator
     */
    protected $translator;

    /**
     * Translate a message
     *
     * @param  string $message
     * @param  string $textDomain
     * @param  string $locale
     * @return string
     */
    public function __invoke($message, $textDomain = 'default', $locale = null)
    {
        return $this->getTranslator()->translate($message, $textDomain, $locale);
    }

    /**
     * Get translator
     *
     * @return Translator
     */
    public function getTranslator()
    {
        if (! $this->translator instanceof Translator) {
            $this->setTranslator($this->getController()->getServiceLocator()->get('Translator'));
        }
        return $this->translator;
    }

    /**
     * Set translator
     *
     * @param  Translator $translator
     * @return Translator
     */
    public function setTranslator(Translator $translator)
    {
        $this->translator = $translator;
        return $this;
    }
}