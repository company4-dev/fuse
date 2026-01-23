<?php

namespace Fuse\Mail;

use Fuse\Helpers\Collection;
use Fuse\Helpers\Log;
use Fuse\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class BaseMail extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    protected $markdown_view;
    protected $text_view;
    protected $to_attach = [];
    protected $view_data;

    public function __construct(
        User $recipient,
        array|Collection $data = [],
        ?string $subject = null,
        ?array $attachments = null,
    ) {
        $class = class_basename(static::class);

        // Data
        if ($data instanceof Collection) {
            $data = $data->toArray();
        }

        if (!is_array($data)) {
            $data = ['data' => $data];
        }

        $this->view_data = array_merge(
            $data,
            [
                'link_base' => url('').'/',
                'recipient' => $recipient,
            ]
        );

        // Subject
        $this->subject = $subject ?? Str::headline($class);

        // Views
        $base_view     = 'mail.'.$class;
        $markdown_view = $base_view.'.markdown';
        $text_view     = $base_view.'.text';

        if (!View::exists($markdown_view)) {
            if (!View::exists($base_view)) {
                Log::emergency($base_view.' does not exist.');

                return;
            }

            $this->markdown_view = $base_view;
        } else {
            $this->markdown_view = $markdown_view;
        }

        if (View::exists($text_view)) {
            $this->text_view = $text_view;
        }

        // Attachments
        if ($attachments) {
            // /path/to/file.pdf => file
            // 0                 => /path/to/file.pdf
            foreach ($attachments as $file => $as) {
                if (is_numeric($file)) {
                    $file = $as;
                    $as   = Str::title(str_replace('-', ' ', basename($as)));
                }

                if (!Storage::exists($file)) {
                    continue;
                }

                $mime = mime_content_type(Storage::path($file));

                $this->to_attach[] = [
                    'as'   => $as,
                    'file' => $file,
                    'mime' => $mime,
                ];
            }
        }
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from:    new Address($this->view_data['recipient']->email, $this->view_data['recipient']->name),
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            text:     $this->text_view,
            markdown: $this->markdown_view,
            with:     array_merge(
                [
                    'subject' => $this->subject,
                ],
                $this->view_data ?? [],
            )
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];

        if ($this->to_attach) {
            foreach ($this->to_attach as $attachment) {
                $attachments[] = Attachment
                    ::fromStorage($attachment['file'])
                    ->as($attachment['as'])
                    ->withMime($attachment['mime']);
            }
        }

        return $attachments;
    }
}
