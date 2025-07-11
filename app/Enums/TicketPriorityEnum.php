<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TicketPriorityEnum extends Enum
{
    const Low = 'low';
    const Medium = 'medium';
    const High = 'high';
}
