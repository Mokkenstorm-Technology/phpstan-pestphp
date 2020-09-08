<?php declare(strict_types=1);

namespace PestPHPStan;

use PHPStan\Reflection\{
    ClassReflection,
    MethodReflection,
    MethodsClassReflectionExtension
};

class TestCaseExtension implements MethodsClassReflectionExtension
{
    public function hasMethod(ClassReflection $classReflection, string $method) : bool
    {
        return true;
    }

    public function getMethod(ClassReflection $classReflection, string $method) : MethodReflection
    {
        return new TestCaseMethodReflection($classReflection, $method);
    }
}

