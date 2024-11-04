<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

trait Searchable
{
    protected function scopeSearch($query)
    {
        [$searchTerm, $attributes] = $this->parseArguments(func_get_args());

        if (! $searchTerm || ! $attributes) {
            return $query;
        }

        return $query->where(function (Builder $query) use ($searchTerm, $attributes) {
            foreach ($attributes as $attribute) {
                $query->when(str_contains($attribute, '.'), function (Builder $query) use ($searchTerm, $attribute) {
                    $this->applyNestedSearch($query, $searchTerm, $attribute);
                }, function (Builder $query) use ($searchTerm, $attribute) {
                    $query->orWhere(DB::raw('LOWER('.$attribute.')'), 'LIKE', "%{$searchTerm}%");
                });
            }
        });
    }

    private function parseArguments(array $arguments)
    {
        $args_count = count($arguments);
        switch ($args_count) {
            case 1:
                return [
                    request(config('searchable.key')),
                    $this->searchableAttributes(),
                ];
                break;
            case 2:
                return is_string($arguments[1]) ? [
                    $arguments[1],
                    $this->searchableAttributes(),
                ] : [
                    request(config('searchable.key')),
                    $arguments[1],
                ];
                break;
            case 3:
                return is_string($arguments[1]) ? [
                    $arguments[1],
                    $arguments[2],
                ] : [
                    $arguments[2],
                    $arguments[1],
                ];
                break;
            default:
                return [
                    null,
                    [],
                ];
                break;
        }
    }

    public function searchableAttributes()
    {
        if (method_exists($this, 'searchable')) {
            return $this->searchable();
        }

        return property_exists($this, 'searchable') ? $this->searchable : [];
    }

    private function applyNestedSearch(Builder $query, $searchTerm, $attribute)
    {
        $path = explode('.', $attribute);
        $lastAttribute = array_pop($path);

        $query->orWhereHas($path[0], function (Builder $query) use ($path, $searchTerm, $lastAttribute) {
            $query->where(DB::raw('LOWER('.$lastAttribute.')'), 'LIKE', "%{$searchTerm}%");
            if (isset($path[1])) {
                $query->orWhereHas($path[1], function (Builder $query) use ($searchTerm, $lastAttribute) {
                    $query->where(DB::raw('LOWER('.$lastAttribute.')'), 'LIKE', "%{$searchTerm}%");
                });
            }
        });
    }
}
