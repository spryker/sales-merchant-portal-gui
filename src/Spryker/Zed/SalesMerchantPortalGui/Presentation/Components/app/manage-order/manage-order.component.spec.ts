import { Component, NO_ERRORS_SCHEMA } from '@angular/core';
import { ComponentFixture, TestBed } from '@angular/core/testing';
import { By } from '@angular/platform-browser';
import { ManageOrderComponent } from './manage-order.component';

@Component({
    standalone: false,
    template: `
        <mp-manage-order [orderDetails]="orderDetails">
            <span state-transitions></span>
            <span state-transitions-message></span>
            <span items-states></span>
            <span items-states-title></span>
            <span class="default-slot"></span>
        </mp-manage-order>
    `,
})
class TestHostComponent {
    orderDetails: any = {};
}

describe('ManageOrderComponent', () => {
    let fixture: ComponentFixture<TestHostComponent>;

    beforeEach(() => {
        TestBed.configureTestingModule({
            declarations: [ManageOrderComponent, TestHostComponent],
            schemas: [NO_ERRORS_SCHEMA],
        });

        fixture = TestBed.createComponent(TestHostComponent);
    });

    it('should render component with `mp-manage-order` host class name', () => {
        fixture.detectChanges();
        const manageOrderElem = fixture.debugElement.query(By.css('.mp-manage-order'));

        expect(manageOrderElem).toBeTruthy();
    });

    it('should render `state-transitions` slot to the `.mp-manage-order__heading-col--actions` element', () => {
        fixture.detectChanges();
        const stateTransitionsSlot = fixture.debugElement.query(
            By.css('.mp-manage-order__heading-col--actions [state-transitions]'),
        );

        expect(stateTransitionsSlot).toBeTruthy();
    });

    it('should render `state-transitions-message` slot to the `.mp-manage-order__transitions-message` element', () => {
        fixture.detectChanges();
        const stateTransitionsMessageSlot = fixture.debugElement.query(
            By.css('.mp-manage-order__transitions-message [state-transitions-message]'),
        );

        expect(stateTransitionsMessageSlot).toBeTruthy();
    });

    it('should render `items-states-title` slot to the `.mp-manage-order__states-col--title` element', () => {
        fixture.detectChanges();
        const itemsStatesTitleSlot = fixture.debugElement.query(
            By.css('.mp-manage-order__states-col--title [items-states-title]'),
        );

        expect(itemsStatesTitleSlot).toBeTruthy();
    });

    it('should render `items-states` slot to the `.mp-manage-order__states-col:last-child` element', () => {
        fixture.detectChanges();
        const itemsStatesSlot = fixture.debugElement.query(
            By.css('.mp-manage-order__states-col:last-child [items-states]'),
        );

        expect(itemsStatesSlot).toBeTruthy();
    });

    it('should render default slot after the `.mp-manage-order__information` element', () => {
        fixture.detectChanges();
        const defaultSlot = fixture.debugElement.query(By.css('.mp-manage-order__information + .default-slot'));

        expect(defaultSlot).toBeTruthy();
    });

    it('should render `@Input(orderDetails)` data to the appropriate places', () => {
        const mockOrderDetails = {
            title: 'title',
            referenceTitle: 'referenceTitle',
            reference: 'reference',
        };
        fixture.componentInstance.orderDetails = mockOrderDetails;
        fixture.detectChanges();
        const titleElem = fixture.debugElement.query(By.css('.mp-manage-order__title'));
        const referenceTitleElem = fixture.debugElement.query(By.css('.mp-manage-order__reference-title'));
        const referenceElem = fixture.debugElement.query(By.css('.mp-manage-order__reference'));

        expect(titleElem.nativeElement.textContent).toContain(mockOrderDetails.title);
        expect(referenceTitleElem.nativeElement.textContent).toContain(mockOrderDetails.referenceTitle);
        expect(referenceElem.nativeElement.textContent).toContain(mockOrderDetails.reference);
    });
});
