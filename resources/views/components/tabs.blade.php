<flux:tab.group>
    <flux:tabs>
        @foreach ($tabs as $slug => $tab)
            <flux:tab :name="$slug" :icon="$tab['icon']">{{ ___($tab['label']) }}</flux:tab>
        @endforeach
    </flux:tabs>

    {{ $slot }}
</flux:tab.group>
