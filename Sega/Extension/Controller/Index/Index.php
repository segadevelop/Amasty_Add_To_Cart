<?php

namespace Sega\Extension\Controller\Index;

use Magento\Framework\App\Action\Context,
    Magento\Framework\View\Result\PageFactory,
    Magento\Framework\App\Action\Action;

use Sega\Extension\Model\Product;

/**
 * Class Index
 * @package Sega\Extension\Controller\Index
 */
class Index extends Action
{
    /**
     * @var PageFactory
     */
    protected $pageFactory;

    protected $product;

    public function __construct(Context $context, PageFactory $pageFactory, Product $product)
    {
        $this->product = $product;
        $this->pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $this->product->getProductBySku();
        return $this->pageFactory->create();
    }
}
