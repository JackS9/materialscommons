<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TileType extends Enum
{
    const Text = 0;
    const Markdown = 1;
    const Chart = 2;
    const Table = 3;
    const File = 4;
}
