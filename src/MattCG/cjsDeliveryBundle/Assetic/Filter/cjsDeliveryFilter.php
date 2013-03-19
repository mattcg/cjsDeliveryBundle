<?php

namespace MattCG\cjsDeliveryBundle\Assetic\Filter;

use Assetic\Asset\AssetInterface;
use Assetic\Filter\FilterInterface;

use MattCG\cjsDelivery\DeliveryFactory;

class cjsDeliveryFilter implements FilterInterface {

	const EXT_JS = 'js';

	private $minifyIdentifiers = false;

	private function stripExtension($filepath) {
		return preg_replace('/\.' . self::EXT_JS . '$/', '', $filepath);
	}

	public function setMinifyIdentifiers($minifyIdentifiers) {
		$this->minifyIdentifiers = $minifyIdentifiers;
	}

	public function filterLoad(AssetInterface $asset) {}

	public function filterDump(AssetInterface $asset) {
		$filepath = $asset->getSourceRoot() . '/' . $asset->getSourcePath();
		$moduleidentifier = $this->stripExtension($filepath);

		$delivery = DeliveryFactory::create(array('minifyIdentifiers' => $this->minifyIdentifiers));
		$delivery->addModule($moduleidentifier);
		$delivery->setMainModule($moduleidentifier);

		$content = $delivery->getOutput();
		$asset->setContent($content);
	}
}
