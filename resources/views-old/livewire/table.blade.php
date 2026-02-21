<?php

use App\Helpers\Platforms;
use App\View\Forms\Table;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithPagination;

// We have to use class-style the global updating for the filters
new class extends Component
{
    use WithPagination;

    public array $actions;
    public array $columns;
    public ?array $data = null;
    public array $filters;
    public bool $manual = false;
    public string $form_class;
    public string $table_class;
    public Table $form;
    public $table;

    #[Locked]
    public ?int $id = null;

    public function getTableData(): array
    {
        $table = new $this->table_class($this->id, $this->data);

        return [
            'columns'     => $table->getHeaders(),
            'has_actions' => $table->hasActions(),
            'models'      => $table->getModels($this),
            'table'       => $table,
        ];
    }

    public function boot()
    {
        $table_class = null;

        if (!$this->manual) {
            if (str_contains($this->table, '::')) {
                $table_class        = 'Platforms\\';
                [$platform, $table] = explode('::', $this->table);
            } else {
                $platform    = null;
                $table       = $this->table;
                $table_class = 'App\\View\\Tables\\';
            }

            [$feature, $table] = array_pad(explode('.', $table), 2, null);

            if ($platform) {
                $platform     = Platforms::find($platform);
                $table_class .= $platform->getName().'\\View\\Tables\\';
            }

            if (!$table) {
                $table = $feature;
            } else {
                $table_class .= Str::studly($feature).'\\';
            }

            $table_class .= Str::studly($table);

            $this->form_class  = $this->form::class;
            $this->table_class = $table_class;
        }
    }

    public function mount(?string $table = null, $id = null, ?array $data = null, bool $manual = false)
    {
        $this->data   = $data;
        $this->id     = $id;
        $this->manual = $manual;
        $this->table  = $table;
    }
}

?>
@php
    if (!$this->manual) {
        $table = $this->getTableData();
    }
@endphp

<div>
    @if ($this->manual)
        <flux:table>
            <flux:table.columns>
                @foreach (array_keys($data[0]) as $column)
                    <flux:table.column>{{ ___($column) }}</flux:table.column>
                @endforeach
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($data as $i => $row)
                    <flux:table.row :key="$i">
                        @foreach ($row as $value)
                            <flux:table.cell>
                                {!! $value !!}
                            </flux:table.cell>
                        @endforeach
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    @else
        <flux:card class="mb-3">
            <x-form :$form :table="$table['table']" type="inline" />
        </flux:card>

        @if($table['models']->isEmpty())
            <x-callout variant="secondary">{{ ___('phrases.no-results') }}</x-callout>
        @else
            <flux:table :paginate="$table['models']">
                <flux:table.columns>
                    @foreach ($table['columns'] as $column => $details)
                        <flux:table.column>{{ ___($column) }}</flux:table.column>
                    @endforeach

                    @if ($table['has_actions'])
                        <flux:table.column>{{ ___('dictionary.actions') }}</flux:table.column>
                    @endif
                </flux:table.columns>

                <flux:table.rows>
                    @foreach ($table['models'] as $model)
                        <flux:table.row :key="$model->id">
                            @foreach ($table['columns'] as $column => $details)
                                <flux:table.cell>
                                    @if ($column === 'debug')
                                        @if (is_callable($details))
                                            @dump($details($model))
                                        @else
                                            @dump($model->toArray())
                                        @endif
                                    @elseif (array_key_exists('columns', $details))
                                        @foreach ((array) $details['columns'] as $column)
                                            @if (isset($details['status']))
                                                @if (is_callable($details['status']))
                                                    @php($status = $details['status']($model->{$column}, $model))

                                                    <flux:badge size="sm" :color="$status['color']" inset="top bottom">
                                                        {{ ___($status['label']) }}
                                                    </flux:badge>
                                                @endif
                                            @elseif (isset ($details['value']) && is_callable($details['value']))
                                                {!! $details['value']($model->{$column}, $model) !!}
                                            @else
                                                {!! $model->{$column} !!}
                                            @endif
                                        @endforeach
                                    @elseif (isset ($details['value']) && is_callable($details['value']))
                                        {!! $details['value'](null, $model) !!}
                                    @endif
                                </flux:table.cell>
                            @endforeach

                            @if ($table['has_actions'])
                                <flux:table.cell>
                                    <flux:button.group>
                                        @foreach ($table['table']->getActions($model) as $i => $action)
                                            <flux:button
                                                :href="$action['href']
                                                    ? $action['href']
                                                    : route($action['route'], isset($action['id']) ? $action['id'] : null)"
                                                :icon:trailing="$action['href'] && $action['target'] !== '_self'
                                                    ? 'arrow-up-right-from-square'
                                                    : null"
                                                size="sm"
                                                :target="$action['target']"
                                                :variant="$action['type'] === 'view' ? ($i === 0 ? 'primary' : null) : null"
                                            >
                                                {{ ___($action['label']) }}
                                            </flux:button>
                                        @endforeach
                                    </flux:button.group>
                                </flux:table.cell>
                            @endif
                        </flux:table.row>
                    @endforeach
                </flux:table.rows>
            </flux:table>
        @endif
    @endif
</div>
