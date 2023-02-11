import { ComponentFixture, TestBed } from '@angular/core/testing';

import { BookingMaterialComponent } from './booking-material.component';

describe('BookingMaterialComponent', () => {
  let component: BookingMaterialComponent;
  let fixture: ComponentFixture<BookingMaterialComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ BookingMaterialComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(BookingMaterialComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
