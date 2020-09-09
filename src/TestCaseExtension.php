<?php declare(strict_types=1);

namespace PestPHPStan;

use Pest\PendingObjects\TestCall;

use PHPUnit\Framework\TestCase;

use PHPStan\Reflection\{
    ClassReflection,
    MethodReflection,
    MethodsClassReflectionExtension
};

class TestCaseExtension implements MethodsClassReflectionExtension
{
    public function hasMethod(ClassReflection $classReflection, string $method) : bool
    {
        if ($classReflection->getName() !== TestCall::class) {
            return false;
        }

        return method_exists(TestCase::class, $method);
    }

    public function getMethod(ClassReflection $classReflection, string $method) : MethodReflection
    {
        return new TestCaseMethodReflection($classReflection, $method);
    }
}

