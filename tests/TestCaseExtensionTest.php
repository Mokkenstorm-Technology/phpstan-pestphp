<?php declare(strict_types = 1);

namespace Tests;

use PestPHPStan\TestCaseExtension;
use Pest\PendingObjects\TestCall;
use PHPStan\{Testing\TestCase, Broker\Broker};

class TestCaseExtensionTest extends TestCase
{
    private Broker $broker;

    private TestCaseExtension $extension;

    protected function setUp() : void
    {
        $this->broker = $this->createBroker();
        $this->extension = new TestCaseExtension($this->broker);
    }

    /**
     * @return array<string, array{0: class-string,1: string, 2: boolean}>
     */
    public function data(): array
    {
        return [
            
            'default object case' => [
                \stdClass::class,
                'foo',
                false
            ],
            
            'default testcall case' => [
                TestCall::class,
                'assertTrue',
                true
            ],
            
            'invalid testcall case' => [
                TestCall::class,
                'assertTue',
                false
            ]
        ];
    }

    /**
     * @dataProvider data
     * @param class-string $className
     */
    public function testHasMethod(string $className, string $method, bool $result): void
    {
        $reflection = $this->broker->getClass($className);

        self::assertSame($result, $this->extension->hasMethod($reflection, $method));
    }
}
