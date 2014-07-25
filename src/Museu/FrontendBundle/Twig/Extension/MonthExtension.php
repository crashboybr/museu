<?php
// src/Acme/DemoBundle/Twig/AcmeExtension.php
namespace Museu\FrontendBundle\Twig\Extension;

class MonthExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('month', array($this, 'monthFilter')),
        );
    }

    public function monthFilter($month)
    {
        if ($month == 1) $month = "Janeiro";
        if ($month == 2) $month = "Fevereiro";
        if ($month == 3) $month = "Março";
        if ($month == 4) $month = "Abril";
        if ($month == 5) $month = "Maio";
        if ($month == 6) $month = "Junho";
        if ($month == 7) $month = "Julho";
        if ($month == 8) $month = "Agosto";
        if ($month == 9) $month = "Setembro";
        if ($month == 10) $month = "Outubro";
        if ($month == 11) $month = "Novembro";
        if ($month == 12) $month = "Dezembro";

        return $month;
    }

    public function getName()
    {
        return 'acme_extension';
    }
}