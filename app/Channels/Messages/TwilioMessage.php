<?php

namespace App\Channels\Messages;

class TwilioMessage
{
    /**
     * The message content
     * 
     * @var string
     */
    public $content;

    /**
     * Set the message content.
     * 
     * @param strign $content
     * 
     * @return $this
     */
    public function content($content)
    {
        $this->content = $content;

        return $this;
    }
}
