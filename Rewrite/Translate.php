<?php
declare(strict_types=1);

namespace Yireo\AdditionalLanguageFile\Rewrite;

class Translate extends \Magento\Framework\Translate
{
    private const LOCALE_PATTERN = '/^[a-z]{2,3}(_[A-Za-z0-9]{2,4}){0,2}$/';

    /**
     * @return $this
     */
    protected function _loadThemeTranslation()
    {
        parent::_loadThemeTranslation();

        $locale = (string)$this->getLocale();
        if (!preg_match(self::LOCALE_PATTERN, $locale)) {
            return $this;
        }

        $additionalFile = $this->_viewFileSystem->getLocaleFileName(
            'i18n/' . $locale . '_additional.csv',
            $this->_config
        );

        if ($additionalFile) {
            $this->_addData($this->_getFileData($additionalFile));
        }

        return $this;
    }
}
