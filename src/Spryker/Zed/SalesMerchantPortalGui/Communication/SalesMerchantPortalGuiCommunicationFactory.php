<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\SalesMerchantPortalGui\Communication;

use Spryker\Shared\GuiTable\DataProvider\GuiTableDataProviderInterface;
use Spryker\Shared\GuiTable\GuiTableFactoryInterface;
use Spryker\Shared\GuiTable\Http\GuiTableDataRequestExecutorInterface;
use Spryker\Shared\ZedUi\ZedUiFactoryInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Spryker\Zed\SalesMerchantPortalGui\Communication\ConfigurationProvider\MerchantOrderGuiTableConfigurationProvider;
use Spryker\Zed\SalesMerchantPortalGui\Communication\ConfigurationProvider\MerchantOrderGuiTableConfigurationProviderInterface;
use Spryker\Zed\SalesMerchantPortalGui\Communication\ConfigurationProvider\MerchantOrderItemGuiTableConfigurationProvider;
use Spryker\Zed\SalesMerchantPortalGui\Communication\ConfigurationProvider\MerchantOrderItemGuiTableConfigurationProviderInterface;
use Spryker\Zed\SalesMerchantPortalGui\Communication\DataProvider\MerchantOrderGuiTableDataProvider;
use Spryker\Zed\SalesMerchantPortalGui\Communication\DataProvider\MerchantOrderItemGuiTableDataProvider;
use Spryker\Zed\SalesMerchantPortalGui\Communication\DataProvider\OrdersDashboardCardProvider;
use Spryker\Zed\SalesMerchantPortalGui\Communication\DataProvider\OrdersDashboardCardProviderInterface;
use Spryker\Zed\SalesMerchantPortalGui\Dependency\Facade\SalesMerchantPortalGuiToCurrencyFacadeInterface;
use Spryker\Zed\SalesMerchantPortalGui\Dependency\Facade\SalesMerchantPortalGuiToMerchantOmsFacadeInterface;
use Spryker\Zed\SalesMerchantPortalGui\Dependency\Facade\SalesMerchantPortalGuiToMerchantSalesOrderFacadeInterface;
use Spryker\Zed\SalesMerchantPortalGui\Dependency\Facade\SalesMerchantPortalGuiToMerchantUserFacadeInterface;
use Spryker\Zed\SalesMerchantPortalGui\Dependency\Facade\SalesMerchantPortalGuiToMoneyFacadeInterface;
use Spryker\Zed\SalesMerchantPortalGui\Dependency\Facade\SalesMerchantPortalGuiToRouterFacadeInterface;
use Spryker\Zed\SalesMerchantPortalGui\Dependency\Facade\SalesMerchantPortalGuiToSalesFacadeInterface;
use Spryker\Zed\SalesMerchantPortalGui\Dependency\Facade\SalesMerchantPortalGuiToStoreFacadeInterface;
use Spryker\Zed\SalesMerchantPortalGui\Dependency\Facade\SalesMerchantPortalGuiToTranslatorFacadeInterface;
use Spryker\Zed\SalesMerchantPortalGui\SalesMerchantPortalGuiDependencyProvider;
use Twig\Environment;

/**
 * @method \Spryker\Zed\SalesMerchantPortalGui\Persistence\SalesMerchantPortalGuiRepositoryInterface getRepository()
 * @method \Spryker\Zed\SalesMerchantPortalGui\SalesMerchantPortalGuiConfig getConfig()
 */
class SalesMerchantPortalGuiCommunicationFactory extends AbstractCommunicationFactory
{
    public function createMerchantOrderGuiTableConfigurationProvider(): MerchantOrderGuiTableConfigurationProviderInterface
    {
        return new MerchantOrderGuiTableConfigurationProvider(
            $this->getStoreFacade(),
            $this->getMerchantOmsFacade(),
            $this->getMerchantUserFacade(),
            $this->getGuiTableFactory(),
        );
    }

    public function createMerchantOrderItemGuiTableConfigurationProvider(): MerchantOrderItemGuiTableConfigurationProviderInterface
    {
        return new MerchantOrderItemGuiTableConfigurationProvider(
            $this->getMerchantOmsFacade(),
            $this->getMerchantUserFacade(),
            $this->getGuiTableFactory(),
            $this->getTranslatorFacade(),
            $this->getMerchantOrderItemTableExpanderPlugins(),
        );
    }

    public function createMerchantOrderGuiTableDataProvider(): GuiTableDataProviderInterface
    {
        return new MerchantOrderGuiTableDataProvider(
            $this->getRepository(),
            $this->getMerchantUserFacade(),
            $this->getCurrencyFacade(),
            $this->getMoneyFacade(),
        );
    }

    /**
     * @param array<int> $merchantOrderItemIds
     *
     * @return \Spryker\Shared\GuiTable\DataProvider\GuiTableDataProviderInterface
     */
    public function createMerchantOrderItemGuiTableDataProvider(array $merchantOrderItemIds): GuiTableDataProviderInterface
    {
        return new MerchantOrderItemGuiTableDataProvider(
            $this->getRepository(),
            $this->getMerchantUserFacade(),
            $this->getMerchantOmsFacade(),
            $this->getSalesFacade(),
            $merchantOrderItemIds,
            $this->getMerchantOrderItemTableExpanderPlugins(),
        );
    }

    public function createOrdersDashboardCardProvider(): OrdersDashboardCardProviderInterface
    {
        return new OrdersDashboardCardProvider(
            $this->getRepository(),
            $this->getMerchantUserFacade(),
            $this->getRouterFacade(),
            $this->getConfig(),
            $this->getTwigEnvironment(),
        );
    }

    public function getMerchantUserFacade(): SalesMerchantPortalGuiToMerchantUserFacadeInterface
    {
        return $this->getProvidedDependency(SalesMerchantPortalGuiDependencyProvider::FACADE_MERCHANT_USER);
    }

    public function getCurrencyFacade(): SalesMerchantPortalGuiToCurrencyFacadeInterface
    {
        return $this->getProvidedDependency(SalesMerchantPortalGuiDependencyProvider::FACADE_CURRENCY);
    }

    public function getMoneyFacade(): SalesMerchantPortalGuiToMoneyFacadeInterface
    {
        return $this->getProvidedDependency(SalesMerchantPortalGuiDependencyProvider::FACADE_MONEY);
    }

    public function getStoreFacade(): SalesMerchantPortalGuiToStoreFacadeInterface
    {
        return $this->getProvidedDependency(SalesMerchantPortalGuiDependencyProvider::FACADE_STORE);
    }

    public function getMerchantOmsFacade(): SalesMerchantPortalGuiToMerchantOmsFacadeInterface
    {
        return $this->getProvidedDependency(SalesMerchantPortalGuiDependencyProvider::FACADE_MERCHANT_OMS);
    }

    public function getMerchantSalesOrderFacade(): SalesMerchantPortalGuiToMerchantSalesOrderFacadeInterface
    {
        return $this->getProvidedDependency(SalesMerchantPortalGuiDependencyProvider::FACADE_MERCHANT_SALES_ORDER);
    }

    public function getRouterFacade(): SalesMerchantPortalGuiToRouterFacadeInterface
    {
        return $this->getProvidedDependency(SalesMerchantPortalGuiDependencyProvider::FACADE_ROUTER);
    }

    public function getTwigEnvironment(): Environment
    {
        return $this->getProvidedDependency(SalesMerchantPortalGuiDependencyProvider::SERVICE_TWIG);
    }

    public function getSalesFacade(): SalesMerchantPortalGuiToSalesFacadeInterface
    {
        return $this->getProvidedDependency(SalesMerchantPortalGuiDependencyProvider::FACADE_SALES);
    }

    public function getTranslatorFacade(): SalesMerchantPortalGuiToTranslatorFacadeInterface
    {
        return $this->getProvidedDependency(SalesMerchantPortalGuiDependencyProvider::FACADE_TRANSLATOR);
    }

    /**
     * @return array<\Spryker\Zed\SalesMerchantPortalGuiExtension\Dependency\Plugin\MerchantOrderItemTableExpanderPluginInterface>
     */
    public function getMerchantOrderItemTableExpanderPlugins(): array
    {
        return $this->getProvidedDependency(SalesMerchantPortalGuiDependencyProvider::PLUGINS_MERCHANT_ORDER_ITEM_TABLE_EXPANDER);
    }

    public function getGuiTableHttpDataRequestExecutor(): GuiTableDataRequestExecutorInterface
    {
        return $this->getProvidedDependency(SalesMerchantPortalGuiDependencyProvider::SERVICE_GUI_TABLE_HTTP_DATA_REQUEST_EXECUTOR);
    }

    public function getGuiTableFactory(): GuiTableFactoryInterface
    {
        return $this->getProvidedDependency(SalesMerchantPortalGuiDependencyProvider::SERVICE_GUI_TABLE_FACTORY);
    }

    public function getZedUiFactory(): ZedUiFactoryInterface
    {
        return $this->getProvidedDependency(SalesMerchantPortalGuiDependencyProvider::SERVICE_ZED_UI_FACTORY);
    }
}
