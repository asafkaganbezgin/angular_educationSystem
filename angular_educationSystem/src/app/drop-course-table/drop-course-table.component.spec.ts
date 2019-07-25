import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DropCourseTableComponent } from './drop-course-table.component';

describe('DropCourseTableComponent', () => {
  let component: DropCourseTableComponent;
  let fixture: ComponentFixture<DropCourseTableComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DropCourseTableComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DropCourseTableComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
