<?php

namespace App\Services\CRUD\Common;

use App\Repositories\Interfaces\RepositoryInterface;
use App\Services\Common\ServiceResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Validation\Validator;


abstract class BaseService
{
    public function __construct(
        private readonly RepositoryInterface $repository
    )
    {
    }

    abstract public function getModelInstance(): Model;

    abstract public function getValidateModelRules(array $properties): array;

    public function create(array $properties): ServiceResult
    {
        $model = $this->getModelInstance();

        return $this->processSave($properties, $model);
    }

    public function read(int $modelId = null): ServiceResult
    {
        $model = $this->repository->getById($modelId);

        if (!$model) {
            return ServiceResult::createErrorResult('Запись не найдена', status: 404);
        }

        return ServiceResult::createSuccessResult($model);
    }

    public function update(array $properties, ?int $modelId = null): ServiceResult
    {
        $model = $this->repository->getById($modelId);

        if (!$model) {
            return ServiceResult::createErrorResult('Запись не найдена', status: 404);
        }

        return $this->processSave($properties, $model);
    }

    public function processSave(array $properties, Model $model): ServiceResult
    {
        $properties = array_merge($properties, $model->toArray());

        $data = $this->prepareData($properties);

        $validator = $this->validateProperties($data);

        if ($validator->fails()) {
            return ServiceResult::createErrorResult(
                'Переданы некорректные данные',
                $validator->errors()->toArray()
            );
        }

        $model->fill($properties);

        DB::beginTransaction();

        if (!$model->save()) {
            DB::rollBack();
            return ServiceResult::createErrorResult('Не удалось создать запись');
        }

        $processRelationsResult = $this->processRelations($data, $model);

        if ($processRelationsResult->isError) {
            DB::rollBack();
            return ServiceResult::createErrorResult('Не удалось создать запись. Ошибка с зависимыми данными');
        }

        DB::commit();

        return ServiceResult::createSuccessResult($model);
    }

    public function delete(int $modelId): ServiceResult
    {
        $model = $this->repository->getById($modelId);

        if (!$model) {
            return ServiceResult::createErrorResult('Запись не найдена', status: 404);
        }

        if (!$model->delete()) {
            return ServiceResult::createErrorResult('Не удалось удалить запись');
        }

        return ServiceResult::createSuccessResult($modelId);
    }

    public function validateProperties(array $properties): Validator
    {
        return FacadesValidator::make($properties, $this->getValidateModelRules($properties));
    }

    protected function processRelations(array $properties, Model &$model): ServiceResult
    {
        return ServiceResult::createSuccessResult('Успешная обработка зависимых данных');
    }

    protected function prepareData(array $properties): array
    {
        return $properties;
    }
}
