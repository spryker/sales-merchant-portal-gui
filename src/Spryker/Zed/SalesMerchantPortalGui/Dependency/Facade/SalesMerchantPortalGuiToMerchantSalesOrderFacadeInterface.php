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

interface SalesMerchantPortalGuiToMerchantSalesOrderFacadeInterface
{
    public function getMerchantOrderCollection(MerchantOrderCriteriaTransfer $merchantOrderCriteriaTransfer): MerchantOrderCollectionTransfer;

    public function findMerchantOrder(MerchantOrderCriteriaTransfer $merchantOrderCriteriaTransfer): ?MerchantOrderTransfer;

    public function getMerchantOrdersCount(MerchantOrderCriteriaTransfer $merchantOrderCriteriaTransfer): int;

    public function getMerchantOrderItemCollection(MerchantOrderItemCriteriaTransfer $merchantOrderItemCriteriaTransfer): MerchantOrderItemCollectionTransfer;
}
