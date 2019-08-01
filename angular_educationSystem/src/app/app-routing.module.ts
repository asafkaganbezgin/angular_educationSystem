import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { LoginFormComponent } from './login-form/login-form.component';
import { StudentHomeComponent } from './student-home/student-home.component';
import { AuthorizationGuard } from './authorization.guard';
import { GradesTableComponent } from './grades-table/grades-table.component';
import { DropCourseTableComponent } from './drop-course-table/drop-course-table.component';
import { AddCourseComponent } from './add-course/add-course.component';
import { TeachingAssistantHomeComponent } from './teaching-assistant-home/teaching-assistant-home.component';
import { InstructorHomeComponent } from './instructor-home/instructor-home.component';

const routes: Routes = [
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
  }];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
