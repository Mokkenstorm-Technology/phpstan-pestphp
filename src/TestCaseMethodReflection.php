<?php declare(strict_types=1);

namespace PestPHPStan;

use PHPStan\TrinaryLogic;
use PHPStan\Type\{StringType, Type};
use PHPStan\Reflection\{ClassReflection, ClassMemberReflection, MethodReflection};

class TestCaseMethodReflection implements MethodReflection
{
    private ClassReflection $classReflection;

    private string $method;

    public function __construct(ClassReflection $classReflection, string $method)
    {
        $this->classReflection = $classReflection;
        $this->method = $method;
    }

    public function getName(): string
    {
        return $this->method;
    }

    public function getPrototype(): ClassMemberReflection
    {
        return $this;
    }

	/**
	 * @return \PHPStan\Reflection\ParametersAcceptor[]
	 */
    public function getVariants(): array
    {
        return [];
    }

    public function isDeprecated(): TrinaryLogic
    {
        return TrinaryLogic::createNo();
    }

    public function getDeprecatedDescription(): ?string
    {
        return null;
    }

    public function isFinal(): TrinaryLogic
    {
        return TrinaryLogic::createNo();
    }

    public function isInternal(): TrinaryLogic
    {
        return TrinaryLogic::createNo();
    }

    public function getThrowType(): ?Type
    {
        return null;
    }

    public function hasSideEffects(): TrinaryLogic
    {
        return TrinaryLogic::createNo();
    }

    public function getDeclaringClass(): ClassReflection
    {
        return $this;
    }

    public function isStatic(): bool
    {
        return false;
    }

    public function isPrivate(): bool
    {
        return false;
    }

    public function isPublic(): bool
    {
        return true;
    }

    public function getDocComment(): ?string
    {
        return null;
    }
}
