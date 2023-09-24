import { ComponentFixture, TestBed } from '@angular/core/testing';

import { OtherUnitsComponent } from './other-units.component';

describe('OtherUnitsComponent', () => {
  let component: OtherUnitsComponent;
  let fixture: ComponentFixture<OtherUnitsComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ OtherUnitsComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(OtherUnitsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
