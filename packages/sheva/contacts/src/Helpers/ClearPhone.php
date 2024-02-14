<?php

namespace Sheva\Contacts\Helpers;

class ClearPhone
{
    public static function clear(string $phone): int
    {
        return (int)str_replace([' ', '-', '(', ')', '+'], '', $phone);
    }
}
