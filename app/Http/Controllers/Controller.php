<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundHttpException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;
use ReflectionClass;

abstract class Controller
{
    protected $model;
    protected $request;

    public function index() {
        $formRequestClass = $this->getFormRequestClass();
        $rules = [];

        if (class_exists($formRequestClass)) {
            $request = new $formRequestClass();
            $rules = $request->rules();
        }

        $query = $this->model::query();
        $filters = $this->request->all();

        // Filtros extras além do fillable
        $othersFillableFields = [];

        // Filtra todos os campos que estão na propriedade fillable da model
        foreach ($filters as $field => $value) {
            if (in_array($field, $this->model->getFillable()) || in_array($field, $othersFillableFields)) {
                if (isset($rules[$field]) && str_contains($rules[$field], 'string')){
                    $query->where($field, 'like', '%'.trim($value).'%');
                    continue;
                }

                $query->where($field, $value);
            }
        }

        // Ordenação
        $query->orderBy('id', 'desc');

        $data = $query->get();
        $data = $this->convertDataToResourceCollection($data);

        return response()->json($data, 200);
    }

    public function show($id) {
        $data = $this->model::find($id);

        if (!$data) {
            throw new NotFoundHttpException();
        }

        $data = $this->convertDataToResource($data);
        
        return response()->json($data, 200);
    }

    public function store(Request $request) {
        $requestData = $this->validateRequest($request);
        
        $data = $this->model::create($requestData);

        $this->syncBelongToManyRelations($requestData, $data);

        return response()->json($data, 201);
    }

    public function update(Request $request, $id) {
        $data = $this->model::find($id);

        if (!$data) {
            throw new NotFoundHttpException();
        }

        $requestData = $this->validateRequest($request);
        $data->update($requestData);

        $this->syncBelongToManyRelations($requestData, $data);

        return response()->json($data, 200);
    }

    public function destroy($id) {
        $data = $this->model::find($id);

        if (!$data) {
            throw new NotFoundHttpException();
        }

        $data->delete();

        return response()->noContent();
    }

    protected function getFormRequestClass(): string {
        $modelClass = class_basename($this->model);
        $requestClass = "App\\Http\\Requests\\{$modelClass}Request";

        return $requestClass;
    }

    protected function validateRequest(Request $request): mixed {
        $formRequestClass = $this->getFormRequestClass();

        if (class_exists($formRequestClass)) {
            $formRequest = app($formRequestClass);
            $data = $formRequest->validated();
        } else {
            $data = $request->all();
        }

        return $data;
    }

    protected function getResourceClass(): string {
        $modelClass = class_basename($this->model);
        $requestClass = "App\\Http\\Resources\\{$modelClass}Resource";

        return $requestClass;
    }

    protected function convertDataToResource(mixed $data): mixed {
        $resourceClass = $this->getResourceClass();

        if (class_exists($resourceClass)) {
            $data = new $resourceClass($data);
        }

        return $data;
    }

    protected function convertDataToResourceCollection(mixed $data): mixed {
        $resourceClass = $this->getResourceClass();

        if (class_exists($resourceClass)) {
            $data = $resourceClass::collection($data);
        }

        return $data;
    }

    protected function getModelBelongsToManyRelations(): array {
        $relations = [];

        $reflection = new ReflectionClass($this->model);

        foreach ($reflection->getMethods() as $method) {
            if ($method->class != get_class($this->model) || !$method->isPublic() || $method->isStatic()) {
                continue;
            }

            $returnType = $method->getReturnType();
                
            if (!$returnType || !$returnType instanceof \ReflectionNamedType) {
                continue;
            }

            if ($returnType->getName() != BelongsToMany::class) {
                continue;
            }

            $relations[] = $method->getName();
        }

        return $relations;
    }

    protected function syncBelongToManyRelations(mixed $request, Model $model): void {
        $relations = $this->getModelBelongsToManyRelations();

        foreach ($relations as $relation) {
            $this->syncSingleBelongToManyRelation($relation, $request, $model);
        }
    }

    protected function syncSingleBelongToManyRelation(string $relation, mixed $request, Model $model): void {
        if (!isset($request[$relation])) {
            return;
        }

        $ids = collect($request[$relation])->pluck('id')->all();
        $model->{$relation}()->sync($ids);
        $model->load($relation);
    }
}