<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\SalesMerchantPortalGui\Dependency\Facade;

use Generated\Shared\Transfer\MerchantCriteriaTransfer;
use Generated\Shared\Transfer\StateMachineProcessTransfer;

interface SalesMerchantPortalGuiToMerchantOmsFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\MerchantCriteriaTransfer $merchantCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\StateMachineProcessTransfer
     */
    public function getMerchantOmsProcessByMerchant(
        MerchantCriteriaTransfer $merchantCriteriaTransfer
    ): StateMachineProcessTransfer;
}