<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class DateFormatterExtension extends AbstractExtension
{
    /**
     * @return array
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('timestampFormat', [$this, 'timestampFormat']),
            new TwigFilter('dateFormat', [$this, 'dateFormat']),
            new TwigFilter('travelDateTimeFormat', [$this, 'travelDateTimeFormat'])
        ];
    }

    /**
     * @param \DateTime $dateTime
     * @return string
     */
    public function timestampFormat(\DateTime $dateTime)
    {
        return $dateTime->format('d M Y H:i:s');
    }

    /**
     * @param \DateTime $date
     * @return string
     */
    public function dateFormat(\DateTime $date)
    {
        return $date->format('d M Y');
    }

    /**
     * @param \DateTime $date
     * @return string
     */
    public function travelDateTimeFormat(\DateTime $date)
    {
        return $date->format('d M Y H:i');
    }
}
