<?php

namespace OC\PlatformBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class OCPlatformBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
		
	}
}
