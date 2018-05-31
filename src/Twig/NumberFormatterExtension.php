<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Class NumberFormatterExtension
 *
 * @package App\Twig
 */
class NumberFormatterExtension extends AbstractExtension
{
    /**
     * @return array
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('numberTotalFormat', [$this, 'numberTotalFormat'])
        ];
    }

    /**
     * @param string $numberTotal
     *
     * @return string
     */
    public function numberTotalFormat(string $numberTotal): string
    {
        return number_format($numberTotal, 2, ',', '.');
    }
}
