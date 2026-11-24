<?php
declare(strict_types=1);

namespace Yireo\AdditionalLanguageFile\Test\Integration;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\View\FileSystem as ViewFileSystem;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Yireo\AdditionalLanguageFile\Rewrite\Translate;

/**
 * @magentoAppArea frontend
 */
class TranslateTest extends TestCase
{
    private string $additionalFile = '';

    /**
     * @var array<int, array{file: string, params: array<string, mixed>}>
     */
    private array $requestedFiles = [];

    protected function setUp(): void
    {
        $this->additionalFile = sys_get_temp_dir() . '/' . uniqid('yireo_alf_', true) . '.csv';
        file_put_contents($this->additionalFile, '"Yireo ALF Original","Yireo ALF Override"' . "\n");
        $this->requestedFiles = [];
    }

    protected function tearDown(): void
    {
        if (is_file($this->additionalFile)) {
            unlink($this->additionalFile);
        }
    }

    public function testIfAdditionalFileOverridesTranslations(): void
    {
        $translate = $this->createTranslate();
        $translate->setLocale('en_US');
        $translate->loadData('frontend', true);

        $this->assertSame('Yireo ALF Override', $translate->getData()['Yireo ALF Original'] ?? null);

        $additionalRequests = $this->getAdditionalRequests();
        $this->assertCount(1, $additionalRequests);
        $this->assertSame('i18n/en_US_additional.csv', $additionalRequests[0]['file']);
        $this->assertSame('frontend', $additionalRequests[0]['params']['area'] ?? null);
        $this->assertSame('en_US', $additionalRequests[0]['params']['locale'] ?? null);
        $this->assertArrayHasKey('theme', $additionalRequests[0]['params']);
    }

    public function testIfInvalidLocaleIsSkipped(): void
    {
        $translate = $this->createTranslate();
        $translate->setLocale('../../../etc/en_US');
        $translate->loadData('frontend', true);

        $this->assertArrayNotHasKey('Yireo ALF Original', $translate->getData());
        $this->assertCount(0, $this->getAdditionalRequests());
    }

    private function createTranslate(): Translate
    {
        $translate = ObjectManager::getInstance()->create(
            Translate::class,
            ['viewFileSystem' => $this->createViewFileSystem()]
        );
        $this->assertInstanceOf(Translate::class, $translate);

        return $translate;
    }

    private function createViewFileSystem(): ViewFileSystem&MockObject
    {
        $viewFileSystem = $this->createMock(ViewFileSystem::class);
        $viewFileSystem->method('getLocaleFileName')->willReturnCallback(
            function (string $file, array $params = []) {
                $this->requestedFiles[] = ['file' => $file, 'params' => $params];
                return str_ends_with($file, '_additional.csv') ? $this->additionalFile : false;
            }
        );

        return $viewFileSystem;
    }

    /**
     * @return array<int, array{file: string, params: array<string, mixed>}>
     */
    private function getAdditionalRequests(): array
    {
        return array_values(array_filter(
            $this->requestedFiles,
            fn (array $request) => str_ends_with($request['file'], '_additional.csv')
        ));
    }
}
