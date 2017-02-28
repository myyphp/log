<?php
	namespace PHPSTORM_META {
	/** @noinspection PhpUnusedLocalVariableInspection */
	/** @noinspection PhpIllegalArrayKeyTypeInspection */
	$STATIC_METHOD_TYPES = [

		\D('') => [
			'Stock' instanceof Common\Model\StockModel,
			'Adv' instanceof Think\Model\AdvModel,
			'Mongo' instanceof Think\Model\MongoModel,
			'View' instanceof Think\Model\ViewModel,
			'Relation' instanceof Think\Model\RelationModel,
			'Merge' instanceof Think\Model\MergeModel,
		],
		\logic('') => [
			'Goods' instanceof Common\Logic\GoodsLogic,
			'Base' instanceof Common\Logic\BaseLogic,
		],
	];
}