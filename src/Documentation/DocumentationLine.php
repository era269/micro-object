<?php
declare(strict_types=1);


namespace Era269\Microobject\Documentation;


class DocumentationLine
{
    private string $messageClassName;
    private string $methodName;

    public function __construct(string $messageClassName, string $methodName)
    {
        $this->messageClassName = $messageClassName;
        $this->methodName = $methodName;
    }
}
