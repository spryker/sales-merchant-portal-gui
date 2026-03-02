<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\SalesMerchantPortalGui\Dependency\Facade;

use Generated\Shared\Transfer\MerchantOrderCollectionTransfer;
use Generated\Shared\Transfer\MerchantOrderCriteriaTransfer;
use Generated\Shared\Transfer\MerchantOrderItemCollectionTransfer;
use Generated\Shared\Transfer\MerchantOrderItemCriteriaTransfer;
use Generated\Shared\Transfer\MerchantOrderTransfer;

class SalesMerchantPortalGuiToMerchantSalesOrderFacadeBridge implements SalesMerchantPortalGuiToMerchantSalesOrderFacadeInterface
{
    /**
     * @var \Spryker\Zed\MerchantSalesOrder\Business\MerchantSalesOrderFacadeInterface
     */
    protected $merchantSalesOrderFacade;

    /**
     * @param \Spryker\Zed\MerchantSalesOrder\Business\MerchantSalesOrderFacadeInterface $merchantSalesOrderFacade
     */
    public function __construct($merchantSalesOrderFacade)
    {
        $this->merchantSalesOrderFacade = $merchantSalesOrderFacade;
    }

    public function getMerchantOrderCollection(MerchantOrderCriteriaTransfer $merchantOrderCriteriaTransfer): MerchantOrderCollectionTransfer
    {
        return $this->merchantSalesOrderFacade->getMerchantOrderCollection($merchantOrderCriteriaTransfer);
    }

    public function findMerchantOrder(MerchantOrderCriteriaTransfer $merchantOrderCriteriaTransfer): ?MerchantOrderTransfer
    {
        return $this->merchantSalesOrderFacade->findMerchantOrder($merchantOrderCriteriaTransfer);
    }

    public function getMerchantOrdersCount(MerchantOrderCriteriaTransfer $merchantOrderCriteriaTransfer): int
    {
        return $this->merchantSalesOrderFacade->getMerchantOrdersCount($merchantOrderCriteriaTransfer);
    }

    public function getMerchantOrderItemCollection(MerchantOrderItemCriteriaTransfer $merchantOrderItemCriteriaTransfer): MerchantOrderItemCollectionTransfer
    {
        return $this->merchantSalesOrderFacade->getMerchantOrderItemCollection($merchantOrderItemCriteriaTransfer);
    }
}
