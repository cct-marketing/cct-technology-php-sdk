<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastructure\Serialization\Dumper;

$baseDir = __DIR__ . '/../../../../';

require $baseDir . 'vendor/autoload.php';

use CCT\SDK\Infrastructure\Serialization\Mapper\OptimizedMapper;
use EventSauce\ObjectHydrator\ObjectMapperCodeGenerator;
use League\ConstructFinder\ConstructFinder;

$dumpedClassNamed = OptimizedMapper::class;

$dumper = new ObjectMapperCodeGenerator();

$classesToDump = ConstructFinder::locatedIn(
    $baseDir . 'src/Analytics',
    $baseDir . 'src/Campaign',
    $baseDir . 'src/CampaignFlow',
    $baseDir . 'src/Customer',
    $baseDir . 'src/MediaManagement'
)
->exclude('*Client.php', '*Exception.php', '*Factory.php')
->findClassNames();

$code = $dumper->dump($classesToDump, $dumpedClassNamed);
file_put_contents($baseDir . 'src/Infrastructure/Serialization/Mapper/OptimizedMapper.php', $code);
