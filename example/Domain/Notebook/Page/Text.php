<?php

declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Notebook\Page;

use Era269\Microobject\Example\Domain\NormalizableInterface;
use Era269\Normalizable\Traits\NormalizableTrait;
use Stringable;

final class Text implements Stringable, NormalizableInterface
{
    use NormalizableTrait;

    /**
     * @var string[]
     */
    private array $lines;

    public function __construct(string ...$lines)
    {
        $this->lines = $lines;
    }

    public function withLine(string $line): self
    {
        return new self(
            ...[
                ...$this->lines,
                $line,
            ]
        );
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return implode("\n", $this->lines);
    }
}
