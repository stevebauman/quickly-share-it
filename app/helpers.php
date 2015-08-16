<?php

/**
 * Generates a session flash message
 *
 * @param null|string $title
 * @param null|string $message
 *
 * @return null|\App\Http\Flash
 */
function flash($title = null, $message = null)
{
    $flash = new \App\Http\Flash();

    if(func_num_args() === 0) {
        return $flash;
    }

    $flash->info($title, $message);
}
