<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\SalesMerchantPortalGui\Dependency\Facade;

use Generated\Shared\Transfer\MerchantCriteriaTransfer;
use Generated\Shared\Transfer\MerchantOmsTriggerRequestTransfer;
use Generated\Shared\Transfer\MerchantOrderItemCollectionTransfer;
use Generated\Shared\Transfer\StateMachineProcessTransfer;

class SalesMerchantPortalGuiToMerchantOmsFacadeBridge implements SalesMerchantPortalGuiToMerchantOmsFacadeInterface
{
    /**
     * @var \Spryker\Zed\MerchantOms\Business\MerchantOmsFacadeInterface
     */
    protected $merchantOmsFacade;

    /**
     * @param \Spryker\Zed\MerchantOms\Business\MerchantOmsFacadeInterface $merchantOmsFacade
     */
    public function __construct($merchantOmsFacade)
    {
        $this->merchantOmsFacade = $merchantOmsFacade;
    }

    public function getMerchantOmsProcessByMerchant(
        MerchantCriteriaTransfer $merchantCriteriaTransfer
    ): StateMachineProcessTransfer {
        return $this->merchantOmsFacade->getMerchantOmsProcessByMerchant($merchantCriteriaTransfer);
    }

    /**
     * @param array<int> $stateIds
     *
     * @return array<\Generated\Shared\Transfer\StateMachineItemTransfer>
     */
    public function getStateMachineItemsByStateIds(array $stateIds): array
    {
        return $this->merchantOmsFacade->getStateMachineItemsByStateIds($stateIds);
    }

    public function triggerEventForMerchantOrderItems(MerchantOmsTriggerRequestTransfer $merchantOmsTriggerRequestTransfer): int
    {
        return $this->merchantOmsFacade->triggerEventForMerchantOrderItems($merchantOmsTriggerRequestTransfer);
    }

    public function expandMerchantOrderItemsWithManualEvents(
        MerchantOrderItemCollectionTransfer $merchantOrderItemCollectionTransfer
    ): MerchantOrderItemCollectionTransfer {
        return $this->merchantOmsFacade->expandMerchantOrderItemsWithManualEvents($merchantOrderItemCollectionTransfer);
    }
}
