<?php
declare(strict_types=1);


namespace Era269\Microobject;


interface SelfDocumentedInterface
{
    /**
     * @return string[] of supported Message class names
     * ToDo: return a MicroobjectDocumentationInterface
     */
    public function getInterfaceDocumentation(): array;
}
