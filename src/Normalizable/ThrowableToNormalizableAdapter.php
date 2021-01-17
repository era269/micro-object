<?php
declare(strict_types=1);


namespace Era269\Microobject\Normalizable;


use Era269\Microobject\NormalizableInterface;
use Era269\Microobject\Traits\AbstractNormalizableTrait;
use Throwable;

final class ThrowableToNormalizableAdapter implements NormalizableInterface
{
    use AbstractNormalizableTrait;

    private Throwable $throwable;

    public function __construct(Throwable $throwable)
    {
        $this->throwable = $throwable;
    }

    /**
     * @return array<string, string|int|array|bool|float|null>
     */
    protected function getNormalized(): array
    {
        $throwable = $this->throwable;
        $normalized = $this->getNormalizedException($throwable);
        while ($throwable = $throwable->getPrevious()) {
            $normalized['previous'] = $this->getNormalizedException($throwable);
        }
        return $normalized;
    }

    /**
     * @return array<string, string|int|array|bool|float|null>
     */
    private function getNormalizedException(Throwable $throwable): array
    {
        return [
            'message' => $throwable->getMessage(),
            'code' => $throwable->getCode(),
            'file' => $throwable->getFile(),
            'line' => $throwable->getLine(),
            'trace' => $throwable->getTrace(),
        ];
    }
}
