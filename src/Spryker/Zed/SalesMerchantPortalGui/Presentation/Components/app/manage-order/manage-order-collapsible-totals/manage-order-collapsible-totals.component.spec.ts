import { NO_ERRORS_SCHEMA } from '@angular/core';
import { ComponentFixture, TestBed } from '@angular/core/testing';
import { By } from '@angular/platform-browser';
import { ManageOrderCollapsibleTotalsComponent } from './manage-order-collapsible-totals.component';

describe('ManageOrderCollapsibleTotalsComponent', () => {
    let fixture: ComponentFixture<ManageOrderCollapsibleTotalsComponent>;

    beforeEach(() => {
        TestBed.configureTestingModule({
            declarations: [ManageOrderCollapsibleTotalsComponent],
            schemas: [NO_ERRORS_SCHEMA],
        });

        fixture = TestBed.createComponent(ManageOrderCollapsibleTotalsComponent);
    });

    it('should render <spy-html-renderer> component', () => {
        fixture.detectChanges();
        const htmlRendererComponent = fixture.debugElement.query(By.css('spy-html-renderer'));

        expect(htmlRendererComponent).toBeTruthy();
    });

    it('should render <spy-collapsible> component', () => {
        fixture.detectChanges();
        const collapsibleComponent = fixture.debugElement.query(By.css('spy-collapsible'));

        expect(collapsibleComponent).toBeTruthy();
    });

    it('should bound `@Input(url)` to the `urlHtml` input of <spy-html-renderer> component only when `activeChange` event handled on the <spy-collapsible> component', () => {
        const mockUrl = 'url';
        fixture.componentRef.setInput('url', mockUrl);
        fixture.detectChanges();
        const collapsibleComponent = fixture.debugElement.query(By.css('spy-collapsible'));
        const htmlRendererComponent = fixture.debugElement.query(By.css('spy-html-renderer'));

        expect(htmlRendererComponent.nativeElement.urlHtml).toBe(undefined);

        collapsibleComponent.triggerEventHandler('activeChange', true);
        fixture.detectChanges();

        expect(htmlRendererComponent.nativeElement.urlHtml).toBe(mockUrl);
    });
});
