<?php

class FlashBagSession
{
    public function __construct()
    {
        if(session_status() == PHP_SESSION_NONE)
        {
            session_start();
        }

        // Do we have already a flash bag ?
        if(array_key_exists('flash-bag', $_SESSION) == false)
        {
            // No, create it.
            $_SESSION['flash-bag'] = array();
        }
    }

    public function add($category, $message)
    {
        if(array_key_exists($category, $_SESSION['flash-bag']) == false)
        {
            // The specified flash bag category doesn't exist, create it.
            $_SESSION['flash-bag'][$category] = array();
        }

        // Add the specified message with the specified category at the end of the flash bag.
        array_push($_SESSION['flash-bag'][$category], $message);
    }

    public function fetchMessage($category)
    {
        if(array_key_exists($category, $_SESSION['flash-bag']) == false)
        {
            // The specified flash bag category doesn't exist.
            return array();
        }

        // Consume the oldest flash bag message for the specified category.
        return array_shift($_SESSION['flash-bag'][$category]);
    }

    public function fetchMessages($category)
    {
        if(array_key_exists($category, $_SESSION['flash-bag']) == false)
        {
            // The specified flash bag category doesn't exist.
            return array();
        }

        // Consume all the flash bag messages for the specified category.
        $messages = $_SESSION['flash-bag'][$category];

        // The flash bag for the specified category is now empty.
        $_SESSION['flash-bag'][$category] = array();

        return $messages;
    }

    public function hasMessages($category)
    {
        if(array_key_exists($category, $_SESSION['flash-bag']) == false)
        {
            // The specified flash bag category doesn't exist.
            return false;
        }

        // Do we have some messages in the flash bag for the specified category ?
        return empty($_SESSION['flash-bag'][$category]) == false;
    }
}