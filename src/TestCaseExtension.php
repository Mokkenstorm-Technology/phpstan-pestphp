<?php declare(strict_types=1);

namespace PestPHPStan;

use Pest\PendingObjects\TestCall;

use PHPUnit\Framework\TestCase;

use PHPStan\Reflection\{
    ClassReflection,
    MethodReflection,
    MethodsClassReflectionExtension,
    ReflectionProvider
};

class TestCaseExtension implements MethodsClassReflectionExtension
{

    private ReflectionProvider $reflectionProvider;

    public function __construct(ReflectionProvider $reflectionProvider)
    {
        $this->reflectionProvider = $reflectionProvider;
    }

    public function hasMethod(ClassReflection $classReflection, string $method) : bool
    {
        if ($classReflection->getName() !== TestCall::class) {
            return false;
        }

        if (!$this->reflectionProvider->hasClass(TestCase::class)) {
            return false;
        }

        return $this->reflectionProvider->getClass(TestCase::class)->hasNativeMethod($method);
    }

    public function getMethod(ClassReflection $classReflection, string $method) : MethodReflection
    {
        return new TestCaseMethodReflection($classReflection, $method);
    }
}

