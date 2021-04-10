<?php

declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Notebook\Page;


use Era269\Normalizable\Abstraction\AbstractNormalizable;
use Stringable;

final class Text extends AbstractNormalizable implements Stringable
{
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
                $line
            ]
        );
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        return implode("\n", $this->lines);
    }

    protected function getNormalized(): array
    {
        return [
            'lines' => $this->lines
        ];
    }
}
