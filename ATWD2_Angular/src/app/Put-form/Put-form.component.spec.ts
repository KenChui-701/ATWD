import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PutFormComponent } from './Put-form.component';

describe('PutFormComponent', () => {
  let component: PutFormComponent;
  let fixture: ComponentFixture<PutFormComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ PutFormComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(PutFormComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
