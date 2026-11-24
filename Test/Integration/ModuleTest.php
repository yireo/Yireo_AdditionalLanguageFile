<?php
declare(strict_types=1);

namespace Yireo\AdditionalLanguageFile\Test\Integration;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\Translate;
use Magento\Framework\TranslateInterface;
use PHPUnit\Framework\TestCase;
use Yireo\AdditionalLanguageFile\Rewrite\Translate as RewriteTranslate;
use Yireo\IntegrationTestHelper\Test\Integration\Traits\AssertModuleIsEnabled;
use Yireo\IntegrationTestHelper\Test\Integration\Traits\AssertModuleIsRegistered;
use Yireo\IntegrationTestHelper\Test\Integration\Traits\AssertModuleIsRegisteredForReal;

class ModuleTest extends TestCase
{
    use AssertModuleIsEnabled;
    use AssertModuleIsRegistered;
    use AssertModuleIsRegisteredForReal;

    public function testIfModuleWorks(): void
    {
        $this->assertModuleIsEnabled('Yireo_AdditionalLanguageFile');
        $this->assertModuleIsRegistered('Yireo_AdditionalLanguageFile');
        $this->assertModuleIsRegisteredForReal('Yireo_AdditionalLanguageFile');
    }

    public function testIfPreferenceIsActive(): void
    {
        $objectManager = ObjectManager::getInstance();
        $this->assertInstanceOf(RewriteTranslate::class, $objectManager->get(TranslateInterface::class));
        $this->assertInstanceOf(RewriteTranslate::class, $objectManager->get(Translate::class));
    }
}
