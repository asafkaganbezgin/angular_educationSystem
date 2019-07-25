import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { MatInputModule } from '@angular/material/input';
import { MatButtonModule, MatIconModule, MatToolbarModule, MatTableModule } from '@angular/material';

import { RouterModule } from '@angular/router';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { LoginFormComponent } from './login-form/login-form.component';
import { HttpClientModule } from '@angular/common/http';
import { StudentHomeComponent } from './student-home/student-home.component';

import { AuthorizationGuard } from './authorization.guard';
import { AuthorizationService } from './services/authorization-service';
import { TeachingAssistantHomeComponent } from './teaching-assistant-home/teaching-assistant-home.component';
import { InstructorHomeComponent } from './instructor-home/instructor-home.component';
import { NavBarComponent } from './nav-bar/nav-bar.component';
import { GradesTableComponent} from './grades-table/grades-table.component';
import { DropCourseTableComponent } from './drop-course-table/drop-course-table.component';
import { AddCourseComponent } from './add-course/add-course.component';

@NgModule({
  declarations: [
    AppComponent,
    LoginFormComponent,
    StudentHomeComponent,
    TeachingAssistantHomeComponent,
    InstructorHomeComponent,
    NavBarComponent,
    GradesTableComponent,
    DropCourseTableComponent,
    AddCourseComponent
  ],
  imports: [
    BrowserModule,
    BrowserAnimationsModule,
    FormsModule,
    HttpClientModule,
    AppRoutingModule,
    MatInputModule,
    MatButtonModule,
    MatIconModule,
    ReactiveFormsModule,
    RouterModule.forRoot([
      {
        path: '',
        component: LoginFormComponent
      },
      {
        path: 'login',
        component: LoginFormComponent
      },
      {
        path: 'student-home',
        component: StudentHomeComponent,
        canActivate: [AuthorizationGuard]
      },
      {
        path: 'student-home/showGrades',
        component: GradesTableComponent,
        canActivate: [AuthorizationGuard]
      },
      {
        path: 'student-home/dropCourse',
        component: DropCourseTableComponent,
        canActivate: [AuthorizationGuard]
      },
      {
        path: 'student-home/addCourse',
        component: AddCourseComponent,
        canActivate: [AuthorizationGuard]
      },
      {
        path: 'teaching-assistant-home',
        component: TeachingAssistantHomeComponent,
        canActivate: [AuthorizationGuard]
      },
      {
        path: 'instructor-home',
        component: InstructorHomeComponent,
        canActivate: [AuthorizationGuard]
      }
    ]),
    MatToolbarModule,
    MatTableModule
  ],
  providers: [AuthorizationService, AuthorizationGuard],
  bootstrap: [AppComponent]
})
export class AppModule { }
