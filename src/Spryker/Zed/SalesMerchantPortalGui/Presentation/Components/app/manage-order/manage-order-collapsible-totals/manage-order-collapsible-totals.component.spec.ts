import {
    ChangeDetectorRef,
    Component,
    ContentChild,
    EventEmitter,
    Input,
    NO_ERRORS_SCHEMA,
    Output,
    TemplateRef,
} from '@angular/core';
import { ComponentFixture, TestBed } from '@angular/core/testing';
import { By } from '@angular/platform-browser';
import { ManageOrderCollapsibleTotalsComponent } from './manage-order-collapsible-totals.component';

/**
 * Mirrors the content rendering of `spy-collapsible`: the projected template is stamped
 * only when `alwaysRender` is true or the panel is active.
 */
@Component({
    standalone: false,
    // Test double for `@spryker/collapsible`: must match its `spy-collapsible` selector to stand in for it.
    // eslint-disable-next-line @angular-eslint/component-selector
    selector: 'spy-collapsible',
    template: `
        @if (alwaysRender || active) {
            <ng-container *ngTemplateOutlet="contentTemplate"></ng-container>
        }
    `,
})
class CollapsibleStubComponent {
    @Input() spyTitle = '';
    @Input() alwaysRender = true;
    @Output() activeChange = new EventEmitter<boolean>();

    @ContentChild(TemplateRef) contentTemplate?: TemplateRef<unknown>;

    active = false;
}

describe('ManageOrderCollapsibleTotalsComponent', () => {
    const mockUrl = 'url';
    const mockTitle = 'title';
    let fixture: ComponentFixture<ManageOrderCollapsibleTotalsComponent>;

    const getCollapsible = () => fixture.debugElement.query(By.directive(CollapsibleStubComponent));
    const getHtmlRenderer = () => fixture.debugElement.query(By.css('spy-html-renderer'));

    const expandCollapsible = (): void => {
        const collapsible = getCollapsible();

        collapsible.componentInstance.active = true;
        collapsible.injector.get(ChangeDetectorRef).detectChanges();
    };

    beforeEach(() => {
        TestBed.configureTestingModule({
            declarations: [ManageOrderCollapsibleTotalsComponent, CollapsibleStubComponent],
            schemas: [NO_ERRORS_SCHEMA],
        });

        fixture = TestBed.createComponent(ManageOrderCollapsibleTotalsComponent);
        fixture.componentRef.setInput('url', mockUrl);
        fixture.componentRef.setInput('spyTitle', mockTitle);
        fixture.detectChanges();
    });

    it('should render <spy-collapsible> component with `spyTitle` and `alwaysRender` disabled', () => {
        const collapsible = getCollapsible();

        expect(collapsible).toBeTruthy();
        expect(collapsible.componentInstance.spyTitle).toBe(mockTitle);
        expect(collapsible.componentInstance.alwaysRender).toBe(false);
    });

    it('should not render <spy-html-renderer> component while <spy-collapsible> is collapsed', () => {
        expect(getHtmlRenderer()).toBeNull();
    });

    it('should render <spy-html-renderer> component with `url` bound to `urlHtml` once <spy-collapsible> is expanded', () => {
        expandCollapsible();

        const htmlRenderer = getHtmlRenderer();

        expect(htmlRenderer).toBeTruthy();
        expect(htmlRenderer.nativeElement.urlHtml).toBe(mockUrl);
    });
});
