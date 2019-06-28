<?php
namespace Yireo\AdditionalLanguageFile\Rewrite;

class Translate extends \Magento\Framework\Translate
{
    protected function _loadThemeTranslation()
    {
        parent::_loadThemeTranslation();

        $additionalFile = $this->_viewFileSystem->getLocaleFileName(
            'i18n' . '/' . $this->getLocale() . '_additional.csv',
            ['area' => $this->getConfig('area')]
        );

        if ($additionalFile) {
            $this->_addData($this->_getFileData($additionalFile));
        }

        return $this;
    }
}
