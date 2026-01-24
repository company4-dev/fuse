<flux:modal
    name="confirm"
    class="min-w-[22rem]"
    x-data="{
        callback: null,
        message: null,
        cancelText: null,
        confirmText: null,
        title: 'Confirm'
    }"
    @show-confirm-modal.window="
        message = $event.detail.message;
        title = $event.detail.title;
        cancelText = $event.detail.cancelText;
        confirmText = $event.detail.confirmText;
        callback = $event.detail.callback;

        $flux.modal('confirm').show();
    "
>
    <div class="space-y-6">
        <div>
            <flux:heading size="lg" x-text="title" />
            <flux:text class="mt-2" x-html="message" />
        </div>
        <div class="flex gap-2">
            <flux:spacer />

            <flux:modal.close>
                <flux:button variant="ghost" x-text="cancelText" />
            </flux:modal.close>

            <flux:button
                type="submit"
                variant="danger"
                x-on:click="
                    $dispatch(callback);

                    $flux.modal('confirm').close();
                "
                x-text="confirmText"
            />
        </div>
    </div>
</flux:modal>
