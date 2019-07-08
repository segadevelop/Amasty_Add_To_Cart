<?php

namespace Sega\Extension\Model;

use \Magento\Catalog\Api\ProductRepositoryInterface,
    \Magento\Framework\Data\Form\FormKey,
    \Magento\Checkout\Model\Cart,
    \Magento\Framework\App\Request\Http;

/**
 * Class Product
 * @package Sega\Extension\Model
 */
class Product
{
    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @var Http
     */
    protected $request;

    /**
     * @var FormKey
     */
    protected $formKey;

    /**
     * @var Cart
     */
    protected $cart;

    /**
     * Product constructor.
     * @param ProductRepositoryInterface $productRepository
     * @param FormKey $formKey
     * @param Cart $cart
     * @param Http $request
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        FormKey $formKey,
        Cart $cart,
        Http $request
    ) {
        $this->productRepository = $productRepository;
        $this->formKey = $formKey;
        $this->cart = $cart;
        $this->request = $request;
    }

    /**
     * @param $productObj
     * @param $params
     * @throws \Magento\Framework\Exception\LocalizedException
     */
//    public function addCustomProduct($productObj, $params)
//    {
//        $this->cart->addProduct($productObj, $params);
//        $this->cart->save();
//    }

    /**
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getProductBySku()
    {
        $request = $this->request->getMethod();
        switch ($request)
        {
            case 'POST':
                $sku = $this->request->getParam('search_sku');
                    try {
                        $productObj = $this->productRepository->get($sku);
                        $product_id = $productObj->getId();
                        $params = [
                            'form_key'     => $this->formKey->getFormKey(),
                            'product_id'   => $product_id,
                            'qty'          => 1
                        ];
                        $this->cart->addProduct($productObj, $params);
                        $this->cart->save();
                    }
                    catch (\Exception $e){
                        return 'Error';
                    }
                break;
            default:
            case 'GET':
                //
                break;
        }
    }

}
