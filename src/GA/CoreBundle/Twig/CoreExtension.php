<?php

namespace GA\CoreBundle\Twig;

class CoreExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('price', array($this, 'priceFilter')),
        );
    }

    public function priceFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = '$'.$price;

        return $price;
    }
		
		public function isString($var)
		{
					return is_string($var);
		}
		
		public function isInt($var)
		{
					return is_integer($var);
		}
		
		public function getFunctions()
		{
			return array(
				'isString' => new \Twig_Function_Method($this, 'isString'),
				'isInt' => new \Twig_Function_Method($this, 'isInt')
				
				);
    }

    public function getName()
    {
        return 'core_extension';
    }
}