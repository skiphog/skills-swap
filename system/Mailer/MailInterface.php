<?php

namespace System\Mailer;

interface MailInterface
{
    /**
     * @return string
     */
    public function from();

    /**
     * @return string
     */
    public function subject();

    /**
     * @return string
     */
    public function message();
}
