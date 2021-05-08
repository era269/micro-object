# micro-object

![PHP Stan Badge](https://img.shields.io/badge/PHPStan-level%208-brightgreen.svg?style=flat">)
[![codecov](https://codecov.io/gh/era269/micro-object/branch/master/graph/badge.svg?token=H6VK60D706)](https://codecov.io/gh/era269/micro-object)
## OOP


The library just gives functionality of Message Prcessing and Event Dispatching.
Only one case is described in the Example. See:
* NotebooksPort.php
* NotebookPortTest.php

### process


#### Performance
was used modified `\Era269\Microobject\Example\Tests\NotebookPortTest::testGetText` method
##### Cached
default `\Era269\Microobject\Traits\CanGetMethodNameByMessageTrait` functionality
```php
    public function testGetText(EventStorageInterface $eventStorage): void
    {
        $notebooksPort = $this->getAutowiredNotebookPort($eventStorage);

        echo "\n start: " . var_dump($start = hrtime()) . "\n";
        for ($i = 0; $i <= 1000; $i++) {
            $normalizedTextResponse = $notebooksPort
                ->getText([
                    'notebookId' => self::UNIQUE_ID_NOTEBOOK,
                    'pageId' => self::UNIQUE_ID_PAGE,
                ]);
        }
        echo "\n end: " . var_dump($end = hrtime()) . "\n";
        printf("\n ----------------time-------\n %d.%d ms \n", $end[0] - $start[0], abs($end[1] - $start[1]));

        $expectedText = [
            'first line',
            'second line',
            'third line',
        ];

        self::assertEquals($expectedText, $normalizedTextResponse['payload']['lines']);
    }
```
output:
```
array(2) {
  [0]=>
  int(131238)
  [1]=>
  int(855914676)
}

 start: 
array(2) {
  [0]=>
  int(131238)
  [1]=>
  int(888507531)
}

 end: 

 ----------------avereage-time-------
 0.32592855 ms 
```
#### Without any cache:
modified `\Era269\Microobject\Traits\CanGetMethodNameByMessageTrait` functionality

```php
    private static function getMap(string $className): array
    {
//        if (!empty(static::$methodNamesMap[$className])) {
//            return static::$methodNamesMap[$className];
//        }

```
output:
```
array(2) {
  [0]=>
  int(131658)
  [1]=>
  int(190087943)
}

 start: 
array(2) {
  [0]=>
  int(131658)
  [1]=>
  int(275028022)
}

 end: 

 ----------------avereage-time-------
 0.84940079 ms
 ```
