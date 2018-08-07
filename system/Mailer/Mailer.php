<?php

namespace System\Mailer;

class Mailer
{
    protected $headers = [
        'MIME-Version' => '1.0',
        'Content-type' => 'text/html; charset=utf-8'
    ];

    protected $receiver;

    public function __construct($receiver)
    {
        $this->receiver = implode(',', (array)$receiver);
    }

    public static function to($data)
    {
        return new static($data);
    }

    /**
     * @param MailInterface $mailer
     *
     * @return bool
     */
    public function send(MailInterface $mailer)
    {
        $headers = array_merge($this->headers, [
            'From' => $mailer->from() ?: config('mail'),
        ]);

        return mail($this->receiver, $mailer->subject(), $mailer->message(), $headers);
    }
}
