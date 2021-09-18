<?php


namespace App\Support;


class Message
{
    public static function flash(string $message, string $type = 'success')
    {
        session()->flash('notification', ['message' => $message, 'type' => $type]);
    }
}
