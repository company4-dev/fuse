<?php

namespace Fuse\Helpers;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class Collection extends EloquentCollection
{
    public function selectTree(
        ?int $parent_id = null,
        mixed $value_column = 'name',
        string $key_column = 'id',
        bool $select_parent = false,
        $parent_key = 'parent_id'
    ) {
        $tree = $this->createTree($this->sortBy($parent_key)->toArray(), $parent_id, $parent_key);

        return $this->convertTreeToSelect($tree, $value_column, $key_column, $select_parent);
    }

    public function tree(?int $parent_id = null, $parent_key = 'parent_id')
    {
        return $this->createTree($this->toArray(), $parent_id, $parent_key);
    }

    private function createTree(array $array, ?int $parent_id = null, string $parent_key = 'parent_id'): array
    {
        $tree = [];

        foreach ($array as $item) {
            if (array_key_exists($parent_key, $item)) {
                if ($item[$parent_key] == $parent_id) {
                    if (!isset($tree[$item['id']])) {
                        $tree[$item['id']]              = $item;
                        $tree[$item['id']][$parent_key] = null;
                    }

                    if ($children = $this->createTree($array, $item['id'], $parent_key)) {
                        $tree[$item['id']]['children'] = array_merge(
                            $tree[$item['id']]['children'] ?? [],
                            $children
                        );
                    }
                }
            } else {
                $tree[$item['id']] = $item;
            }
        }

        return $tree;
    }

    private function convertTreeToSelect(
        array $tree,
        mixed $value_column,
        string $key_column,
        bool $select_parent = false,
        $level = 0
    ) {
        $branch = [];

        foreach ($tree as $element) {
            if ($select_parent) {
                if (is_array($value_column)) {
                    $concatenated_value_column = [];
                    foreach ($value_column as $column) {
                        $concatenated_value_column = $element[$column];
                    }
                    $branch[$element[$key_column]] = implode('', array_pad([], $level, '-&nbsp;&nbsp;&nbsp;'))
                        .implode(' ', $concatenated_value_column);
                } else {
                    $branch[$element[$key_column]] = implode('', array_pad([], $level, '-&nbsp;&nbsp;&nbsp;'))
                        .$element[$value_column];
                }

                if (isset($element['children'])) {
                    $branch += $this->convertTreeToSelect(
                        $element['children'],
                        $value_column,
                        $key_column,
                        $select_parent,
                        $level + 1
                    );
                }
            } elseif (isset($element['children'])) {
                $branch[$element[$value_column]] = $this->convertTreeToSelect(
                    $element['children'],
                    $value_column,
                    $key_column,
                    $select_parent,
                    $level + 1
                );
            } elseif (is_array($value_column)) {
                $concatenated_value_column = [];

                foreach ($value_column as $column) {
                    $concatenated_value_column[] = $element[$column];
                }

                $branch[$element[$key_column]] = implode(' ', $concatenated_value_column);
            } else {
                if ($key_column === 'id' && !isset($element[$key_column])) {
                    $element[$key_column] = -1;
                }

                $branch[$element[$key_column]] = $element[$value_column];
            }
        }

        return $branch;
    }

    private function flattenKeys(array $input, string $separator = ' - '): array
    {
        $result = [];

        $recurse = function ($array, $prefix = '') use (&$recurse, &$result, $separator) {
            foreach ($array as $key => $value) {
                $newKey = $prefix === '' ? $key : $prefix.$separator.$key;

                if (is_array($value) && count($value) === 1 && is_array(reset($value))) {
                    // Continue recursion if there's only one nested array
                    $recurse($value, $newKey);
                } else {
                    // Stop recursion and assign the final array
                    $result[$newKey] = $value;
                }
            }
        };

        $recurse($input);

        return $result;
    }
}
