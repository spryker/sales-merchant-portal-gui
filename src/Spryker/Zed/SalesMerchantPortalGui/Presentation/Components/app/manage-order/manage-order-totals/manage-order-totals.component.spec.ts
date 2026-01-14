import { NO_ERRORS_SCHEMA } from '@angular/core';
import { ComponentFixture, TestBed } from '@angular/core/testing';
import { By } from '@angular/platform-browser';
import { ManageOrderTotalsComponent } from './manage-order-totals.component';

describe('ManageOrderTotalsComponent', () => {
    let fixture: ComponentFixture<ManageOrderTotalsComponent>;

    beforeEach(() => {
        TestBed.configureTestingModule({
            declarations: [ManageOrderTotalsComponent],
            schemas: [NO_ERRORS_SCHEMA],
        });

        fixture = TestBed.createComponent(ManageOrderTotalsComponent);
    });

    it('should render list of totals from `@Input(orderTotals)`', () => {
        const mockOrderTotals = [
            {
                title: 'Subtotal',
                value: '€ 972.51',
                isTitle: true,
            },
            {
                title: 'Shipment Hermes Express',
                value: '€ 972.51',
            },
        ];
        fixture.componentRef.setInput('orderTotals', mockOrderTotals);
        fixture.detectChanges();
        const orderTotalElems = fixture.debugElement.queryAll(By.css('.mp-manage-order-totals__item'));

        expect(orderTotalElems.length).toBe(mockOrderTotals.length);

        orderTotalElems.forEach((orderTotalElem, i) => {
            const orderTotalTitleElem = fixture.debugElement.query(
                By.css(`.mp-manage-order-totals__item:nth-child(${i + 1}) .mp-manage-order-totals__col:first-child`),
            );
            const orderValueTitleElem = fixture.debugElement.query(
                By.css(`.mp-manage-order-totals__item:nth-child(${i + 1}) .mp-manage-order-totals__col:last-child`),
            );

            expect(orderTotalTitleElem.nativeElement.textContent).toBe(mockOrderTotals[i].title);
            expect(orderValueTitleElem.nativeElement.textContent).toBe(mockOrderTotals[i].value);
        });
    });

    it('should add `mp-manage-order-totals__item--title` class if `@Input(orderTotals.isTitle)` is true', () => {
        const mockOrderTotals = [
            {
                title: 'Subtotal',
                value: '€ 972.51',
                isTitle: true,
            },
        ];
        fixture.componentRef.setInput('orderTotals', mockOrderTotals);
        fixture.detectChanges();
        const orderTotalTitleElem = fixture.debugElement.query(
            By.css('.mp-manage-order-totals__item.mp-manage-order-totals__item--title'),
        );

        expect(orderTotalTitleElem).toBeTruthy();
    });
});
