<?php
declare(strict_types=1);


namespace Era269\Microobject\Message\Response;


use Era269\Microobject\Example\Domain\Message\MessageId;
use Era269\Microobject\Message\MessageIdInterface;
use Era269\Microobject\Message\ResponseInterface;
use Era269\Microobject\Message\Traits\CreatedAtAwareTrait;
use Era269\Microobject\Normalizable\NullNormalizable;
use Era269\Normalizable\AbstractNormalizableObject;
use Era269\Normalizable\NormalizableInterface;

final class PositiveEmptyResponse extends AbstractNormalizableObject implements ResponseInterface
{
    use CreatedAtAwareTrait;

    private MessageId $id;

    public function __construct()
    {
        $this->setCreatedAt();
        $this->id = MessageId::generate();
    }

    public function getId(): MessageIdInterface
    {
        return $this->id;
    }

    public function getPayload(): NormalizableInterface
    {
        return new NullNormalizable();
    }

    protected function getNormalized(): array
    {
        return [
            'id' => $this->id->normalize(),
        ];
    }
}
