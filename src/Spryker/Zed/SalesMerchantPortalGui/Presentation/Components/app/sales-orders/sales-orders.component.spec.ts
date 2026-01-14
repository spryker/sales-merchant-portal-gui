import { Component, NO_ERRORS_SCHEMA } from '@angular/core';
import { ComponentFixture, TestBed } from '@angular/core/testing';
import { By } from '@angular/platform-browser';
import { SalesOrdersComponent } from './sales-orders.component';

@Component({
    standalone: false,
    template: `
        <mp-sales-orders [tableConfig]="tableConfig" [tableId]="tableId">
            <span title></span>
        </mp-sales-orders>
    `,
})
class TestHostComponent {
    tableConfig: any = {};
    tableId = '';
}

describe('SalesOrdersComponent', () => {
    let fixture: ComponentFixture<TestHostComponent>;

    beforeEach(() => {
        TestBed.configureTestingModule({
            declarations: [SalesOrdersComponent, TestHostComponent],
            schemas: [NO_ERRORS_SCHEMA],
        });

        fixture = TestBed.createComponent(TestHostComponent);
    });

    it('should render <mp-sales-orders-table> component', () => {
        fixture.detectChanges();
        const salesOrdersTableComponent = fixture.debugElement.query(By.css('mp-sales-orders-table'));

        expect(salesOrdersTableComponent).toBeTruthy();
    });

    it('should render <spy-headline> component', () => {
        fixture.detectChanges();
        const headlineComponent = fixture.debugElement.query(By.css('spy-headline'));

        expect(headlineComponent).toBeTruthy();
    });

    it('should render `title` slot to the <spy-headline> component', () => {
        fixture.detectChanges();
        const titleSlot = fixture.debugElement.query(By.css('spy-headline [title]'));

        expect(titleSlot).toBeTruthy();
    });

    it('should bound `@Input(tableConfig)` to the `config` input of <mp-sales-orders-table> component', () => {
        const mockTableConfig = {
            config: 'config',
            data: 'data',
            columns: 'columns',
        };
        fixture.componentInstance.tableConfig = mockTableConfig;
        fixture.detectChanges();
        const salesOrdersTableComponent = fixture.debugElement.query(By.css('mp-sales-orders-table'));

        expect(salesOrdersTableComponent.nativeElement.config).toEqual(mockTableConfig);
    });

    it('should bound `@Input(tableId)` to the `tableId` input of <mp-sales-orders-table> component', () => {
        const mockTableId = 'mockTableId';
        fixture.componentInstance.tableId = mockTableId;
        fixture.detectChanges();
        const salesOrdersTableComponent = fixture.debugElement.query(By.css('mp-sales-orders-table'));

        expect(salesOrdersTableComponent.nativeElement.tableId).toEqual(mockTableId);
    });
});
