<?php

namespace App\Exports;

use App\Base\Export;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Table extends Export implements FromCollection, WithHeadings
{
    use Exportable;

    private array $columns;
    private array $query;
    private Collection $data;
    private string $model;

    public function __construct(User $user, mixed ...$args)
    {
        $this->columns = $args[0]['columns'];
        $this->data    = collect();
        $this->query   = $args[0]['query'];

        parent::__construct(
            $user,
            Str::plural(class_basename($this->query['model'])),
        );
    }

    public function collection(): Collection
    {
        DB
            ::connection($this->query['model']::make()->getConnectionName())
            ->table(DB::raw(sprintf('(%s) as results', $this->query['sql'])))
            ->setBindings($this->query['bindings'])
            ->orderBy('id')
            ->chunk(
                config('settings.lists.chunk-size'),
                $this->process_chunk(...),
            );

        return $this->data;
    }

    public function headings(): array
    {
        return array_map(___(...), array_keys($this->columns));
    }

    private function process_chunk(Collection $rows, int $chunk_number): void
    {
        foreach ($rows as $row) {
            $out = [];

            foreach ($this->columns as $column_name => $details) {
                if (array_key_exists('columns', $details)) {
                    foreach ((array) $details['columns'] as $column) {
                        if (isset($details['status'])) {
                            if (is_callable($details['status'])) {
                                $status = $details['status']($row->{$column}, $row);

                                $out[___($column_name)] = ___($status['label']);
                            }
                        } elseif (isset($details['value']) && is_callable($details['value'])) {
                            $out[___($column_name)] = $details['value']($row->{$column}, $row);
                        } elseif (str_contains($column, '.')) {
                            [$relation, $column] = explode('.', $column);

                            $out[___($column_name)] = $row->{$relation.'_'.$column};
                        } else {
                            $out[___($column_name)] = $row->{$column};
                        }
                    }
                } elseif (isset($details['value'])) {
                    if (is_callable($details['value'])) {
                        $out[___($column_name)] = $details['value'](null, $row);
                    } elseif (str_contains($details['value'], '.')) {
                        [$relation, $column] = explode('.', $details['value']);

                        $out[___($column_name)] = $row->$relation?->$column;
                    }
                }
            }

            $this->data->push($out);
        }
    }
}
