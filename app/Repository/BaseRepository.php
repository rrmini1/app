<?php

declare(strict_types=1);

namespace App\Repository;

use App\Repository\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    public function __construct(protected Model $model) {}
    public function list(): Collection
    {
        $newQuery = $this->model->newQuery();

        return $newQuery->get();
    }

    public function find(int $id): ?Model
    {
        return $this->model->newQuery()->find($id);
    }

    public function create(array $data): Model
    {
        return $this->model->newQuery()->create($data);
    }

    public function update(Model $model, array $data): bool
    {
        return $model->update($data);
    }

    public function delete(Model $model): bool
    {
        return $model->delete();
    }

    public function saveImage(Model $model, string $linkToImage): bool
    {
        $model->image = $linkToImage;
        return $model->save();
    }
}
