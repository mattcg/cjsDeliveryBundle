<?php

namespace MattCG\cjsDeliveryBundle\Assetic\Filter;

use Assetic\Asset\AssetInterface;
use Assetic\Filter\FilterInterface;

use MattCG\cjsDelivery\DeliveryFactory;

class cjsDeliveryFilter implements FilterInterface {

	const EXT_JS = 'js';

	private $minifyidentifiers = false;
	private $includes = null;

	private function stripExtension($filepath) {
		return preg_replace('/\.' . self::EXT_JS . '$/', '', $filepath);
	}

	public function setMinifyIdentifiers($minifyidentifiers) {
		$this->minifyidentifiers = $minifyidentifiers;
	}

	public function setIncludes($includes) {
		$this->includes = $includes;
	}

	public function filterLoad(AssetInterface $asset) {}

	public function filterDump(AssetInterface $asset) {
		$filepath = $asset->getSourceRoot() . '/' . $asset->getSourcePath();
		$moduleidentifier = $this->stripExtension($filepath);

		$options = array();
		$options['includes'] = $this->includes;
		$options['minifyIdentifiers'] = $this->minifyidentifiers;

		$delivery = DeliveryFactory::create($options);
		$delivery->addModule($moduleidentifier, $asset->getContent());
		$delivery->setMainModule($moduleidentifier);

		$content = $delivery->getOutput();
		$asset->setContent($content);
	}
}
