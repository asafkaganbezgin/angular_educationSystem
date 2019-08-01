import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { AuthorizationService } from './authorization-service';
import { DropCourseTableComponent } from '../drop-course-table/drop-course-table.component';

@Injectable({
  providedIn: 'root'
})
export class CourseService {

  // private coursesToBeDeleted: any;

  constructor(private httpClient: HttpClient, private auth: AuthorizationService) {}

  /* Sending the courses to be deleted to server(backend) side. */
  sendCourses(value: any): Observable<any> {
    JSON.parse(JSON.stringify(value));
    return this.httpClient.post<any>('http://localhost/educationSystem/api/delete-course.php', {
      id: this.auth.getId(),
      courses: value
    }, {});
  }

  /* Get methods of the class. */
  getGrades(): Observable<object> {
    return this.httpClient.post<object>('http://localhost/educationSystem/api/get-grades', {
      id: this.auth.getId()
    }, {});
  }

  getCourses(): Observable<object> {
    return this.httpClient.post<object>('http://localhost/educationSystem/api/get-courses', {
      id: this.auth.getId()
    }, {});
  }

  /* Set methods of the class. */
  setCoursesToBeDeleted(value: any) {
    // this.coursesToBeDeleted = value;
    // this.sendCourses().subscribe((data: any) => {
    //   if (data.message === 'success') {
    //     alert('Course/s deleted successfully.');
    //   }
    // });
  }

  /* Getting the available courses from the server. */
  getAvailableCourses(): Observable<object> {
    return this.httpClient.post<object>('http://localhost/educationSystem/api/get-available-courses.php', {
      id: this.auth.getId()
    }, {});
  }

  /* Sending the selected available courses to the server. */
  sendCoursesToBeAdded(value: string[]): Observable<any> {
    return this.httpClient.post<string[]>('http://localhost/educationSystem/api/add-courses.php', {
      id: this.auth.getId(),
      courses: value
    }, {});
  }
}
