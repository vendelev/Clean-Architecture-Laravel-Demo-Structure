<?php

declare(strict_types=1);

namespace CleanStructure\Core\Infrastructure\Monolog;

use Monolog\Formatter\JsonFormatter;
use Monolog\LogRecord;

final class JsonLokiFormatter extends JsonFormatter
{
    public const string SIMPLE_DATE = "Y-m-d\TH:i:s.uP";

    private string $traceID = '';

    public function format(LogRecord $record): string
    {
        $recordData = (new JsonFormatter())->normalizeRecord($record);
        $recordData['traceID'] = $this->traceID;

        return $this->toJson($recordData) . "\n";
    }
}
