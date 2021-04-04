<?php
declare(strict_types=1);


namespace Era269\Microobject;


use IteratorAggregate;

/**
 * @extends \IteratorAggregate<int,object>
 */
interface CollectionInterface extends IteratorAggregate, CountableInterface
{

}
