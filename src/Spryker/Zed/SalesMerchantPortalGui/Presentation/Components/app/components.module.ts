import { NgModule } from '@angular/core';
import { WebComponentsModule } from '@spryker/web-components';
import { ButtonAjaxComponent, ButtonAjaxModule } from '@spryker/button';
import { ChipsComponent, ChipsModule } from '@spryker/chips';
import { CardModule, CardComponent } from '@spryker/card';
import { TabsModule, TabsComponent, TabComponent } from '@spryker/tabs';

import { SalesOrdersComponent } from './sales-orders/sales-orders.component';
import { SalesOrdersModule } from './sales-orders/sales-orders.module';
import { ManageOrderComponent } from './manage-order/manage-order.component';
import { ManageOrderStatsBlockComponent } from './manage-order/manage-order-stats-block/manage-order-stats-block.component';
import { ManageOrderTotalsComponent } from './manage-order/manage-order-totals/manage-order-totals.component';
import { ManageOrderModule } from './manage-order/manage-order.module';
import { OrderItemsTableComponent } from './order-items-table/order-items-table.component';
import { OrderItemsTableModule } from './order-items-table/order-items-table.module';
import { ManageOrderCollapsibleTotalsComponent } from './manage-order/manage-order-collapsible-totals/manage-order-collapsible-totals.component';

@NgModule({
    imports: [
        WebComponentsModule.withComponents([
            TabsComponent,
            SalesOrdersComponent,
            ManageOrderComponent,
            ManageOrderStatsBlockComponent,
            ButtonAjaxComponent,
            ChipsComponent,
            CardComponent,
            TabComponent,
            ManageOrderTotalsComponent,
            OrderItemsTableComponent,
            ManageOrderCollapsibleTotalsComponent,
        ]),
        SalesOrdersModule,
        ButtonAjaxModule,
        ChipsModule,
        CardModule,
        TabsModule,
        ManageOrderModule,
        OrderItemsTableModule,
    ],
})
export class ComponentsModule {}
