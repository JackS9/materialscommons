<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TileType extends Enum
{
    const Notset = 0;
    const Text = 1;
    const File = 2;
    const Chart = 3;
    const Markdown = 4;
    const Table = 5;

}
