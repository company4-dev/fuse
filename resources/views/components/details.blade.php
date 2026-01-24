<dl class="space-y-3">
    @foreach ($details as $detail)
        @if ($detail['value'] === null)
            @continue
        @endif

        <x-detail :icon="$detail['icon']" :label="___($detail['label'])" :value="$detail['value']" />
    @endforeach
</dl>
