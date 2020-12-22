<?php
declare(strict_types=1);


namespace Era269\Microobject\Traits;


trait CanDetectIsMethodCallerInstanceOf
{
    private function isMethodCallerInstanceOfAny(string ...$classNames): bool
    {
        $callerClass = debug_backtrace()[1]['class'] ?? null;
        return !is_null($callerClass)
            && $this->isSubclassOfAny($callerClass, ...$classNames);
    }

    private function isSubclassOfAny(string $subClass, string ...$classNames): bool
    {
        foreach ($classNames as $className) {
            if (is_subclass_of($subClass, $className)) {
                return true;
            }
        }
        return false;
    }
}
