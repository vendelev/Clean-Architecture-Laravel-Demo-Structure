<?php

declare(strict_types=1);

namespace CleanStructure\System\HealthCheck\Application\UseCase;

use CleanStructure\Core\Domain\TransactionInterface;
use CleanStructure\System\HealthCheck\Application\Command\CheckDbWriter;
use CleanStructure\System\HealthCheck\Application\Query\CheckDbReader;
use CleanStructure\System\HealthCheck\Domain\Entity\HealthCheck;
use RuntimeException;

final readonly class DbHealthUseCase
{
    public function __construct(
        private TransactionInterface $transaction,
        private CheckDbReader $dbReader,
        private CheckDbWriter $dbWriter,
    ) {
    }

    public function check(): bool
    {
        $this->transaction->beginTransaction();

        try {
            $this->dbWriter->createTable();

            $testValue = new HealthCheck('test');

            $result = $this->dbWriter->insertValue($testValue);
            if ($result !== true) {
                throw new RuntimeException('Ошибка вставки в БД');
            }

            $values = $this->dbReader->selectAllValues();
            if (count($values) === 0 || $values[0]->dummyColumn !== 'test') {
                throw new RuntimeException('Данные в БД не записались');
            }

            $affectedRowsCount = $this->dbWriter->updateValue('test2', 'test');
            if ($affectedRowsCount !== 1) {
                throw new RuntimeException('Не удалось обновить запись в таблице');
            }

            $values = $this->dbReader->selectAllValues();
            if ($values[0]->dummyColumn !== 'test2') {
                throw new RuntimeException('Данные в БД не обновились');
            }

            $affectedRowsCount = $this->dbWriter->deleteValue('test2');
            if ($affectedRowsCount !== 1) {
                throw new RuntimeException('Не удалось удалить запись');
            }

            $values = $this->dbReader->selectAllValues();
            if (count($values) > 0) {
                throw new RuntimeException('Данные в БД не удалились');
            }
        } finally {
            $this->transaction->rollBack();
        }

        return true;
    }
}
