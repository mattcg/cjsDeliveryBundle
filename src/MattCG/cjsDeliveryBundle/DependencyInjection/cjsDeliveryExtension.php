<?php

namespace MattCG\cjsDeliveryBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;

class cjsDeliveryExtension extends Extension {

	public function load(array $configs, ContainerBuilder $container) {
		$loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
		$loader->load('services.xml');
	}

	public function getAlias() {
		return 'cjs_delivery';
	}
}
