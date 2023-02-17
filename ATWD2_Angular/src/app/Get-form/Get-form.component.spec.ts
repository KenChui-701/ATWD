import { ComponentFixture, TestBed } from '@angular/core/testing';

import { GetFormComponent } from './Get-form.component';

describe('StudentFormComponent', () => {
  let component: GetFormComponent;
  let fixture: ComponentFixture<GetFormComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ GetFormComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(GetFormComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
