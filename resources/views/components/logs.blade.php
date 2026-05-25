<div>
    <livewire:table
        :data="[
            'activity-model'    => isset($model) ? $model::class : 'all',
            'activity-model-id' => isset($model) ? $model->id : null,
        ]"
        lazy
        table="logs"
    />
</div>
