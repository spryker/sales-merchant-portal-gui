import { NO_ERRORS_SCHEMA } from '@angular/core';
import { ComponentFixture, TestBed } from '@angular/core/testing';
import { By } from '@angular/platform-browser';
import { ManageOrderStatsBlockComponent } from './manage-order-stats-block.component';

describe('ManageOrderStatsBlockComponent', () => {
    let fixture: ComponentFixture<ManageOrderStatsBlockComponent>;

    beforeEach(() => {
        TestBed.configureTestingModule({
            declarations: [ManageOrderStatsBlockComponent],
            schemas: [NO_ERRORS_SCHEMA],
        });

        fixture = TestBed.createComponent(ManageOrderStatsBlockComponent);
    });

    it('should render `@Input(name)` to the `.mp-manage-order-stats-block__text--name` element', () => {
        const mockName = 'name';
        fixture.componentRef.setInput('name', mockName);
        fixture.detectChanges();
        const orderStatsBlockNameElem = fixture.debugElement.query(By.css('.mp-manage-order-stats-block__text--name'));

        expect(orderStatsBlockNameElem.nativeElement.textContent).toContain(mockName);
    });

    it('should render `@Input(info)` to the `.mp-manage-order-stats-block__text:last-child` element', () => {
        const mockInfo = 'info';
        fixture.componentRef.setInput('info', mockInfo);
        fixture.detectChanges();
        const orderStatsBlockInfoElem = fixture.debugElement.query(
            By.css('.mp-manage-order-stats-block__text:last-child'),
        );

        expect(orderStatsBlockInfoElem.nativeElement.textContent).toContain(mockInfo);
    });
});
