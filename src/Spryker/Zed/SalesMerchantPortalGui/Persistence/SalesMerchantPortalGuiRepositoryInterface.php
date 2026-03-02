<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\SalesMerchantPortalGui\Persistence;

use Generated\Shared\Transfer\MerchantOrderCollectionTransfer;
use Generated\Shared\Transfer\MerchantOrderCountsTransfer;
use Generated\Shared\Transfer\MerchantOrderItemCollectionTransfer;
use Generated\Shared\Transfer\MerchantOrderItemTableCriteriaTransfer;
use Generated\Shared\Transfer\MerchantOrderTableCriteriaTransfer;

interface SalesMerchantPortalGuiRepositoryInterface
{
    public function getMerchantOrderTableData(
        MerchantOrderTableCriteriaTransfer $merchantOrderTableCriteriaTransfer
    ): MerchantOrderCollectionTransfer;

    public function getMerchantOrderItemTableData(
        MerchantOrderItemTableCriteriaTransfer $merchantOrderItemTableCriteriaTransfer
    ): MerchantOrderItemCollectionTransfer;

    public function getMerchantOrderCounts(int $idMerchant): MerchantOrderCountsTransfer;
}
