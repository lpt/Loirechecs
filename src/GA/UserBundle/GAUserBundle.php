<?php

namespace GA\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GAUserBundle extends Bundle
{
	public function getParent()
    {
        return 'FOSUserBundle';
    }
}
