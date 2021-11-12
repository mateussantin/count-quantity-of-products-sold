<?php
    namespace Mateus\QuantityProductsSold\Helper;

    class Data extends \Magento\Framework\App\Helper\AbstractHelper
    {
        protected $_reportCollectionFactory;
        public function __construct(
            \Magento\Framework\App\Helper\Context $context,
            \Magento\Reports\Model\ResourceModel\Product\Sold\CollectionFactory  $reportCollectionFactory
        ) {
        $this->_reportCollectionFactory = $reportCollectionFactory;
            parent::__construct($context);
        }

        public function getSoldQuantityByProductId($produc_id = null) {
            $product_collection = $this->_reportCollectionFactory->create();
            $qty_sold = $product_collection->addOrderedQty()->addAttributeToFilter('product_id', $produc_id);

            if (!$qty_sold->count()) {
                return false;
            }

            $product = $qty_sold->getFirstItem();

            return (int)$product->getData('ordered_qty');
        }
    }
