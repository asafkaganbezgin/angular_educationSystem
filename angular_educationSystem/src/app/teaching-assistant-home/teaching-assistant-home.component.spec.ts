import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TeachingAssistantHomeComponent } from './teaching-assistant-home.component';

describe('TeachingAssistantHomeComponent', () => {
  let component: TeachingAssistantHomeComponent;
  let fixture: ComponentFixture<TeachingAssistantHomeComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TeachingAssistantHomeComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TeachingAssistantHomeComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
