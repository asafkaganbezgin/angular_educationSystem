import { Component, OnInit } from '@angular/core';
import { CourseService } from '../services/course.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-add-course',
  templateUrl: './add-course.component.html',
  styleUrls: ['./add-course.component.css']
})
export class AddCourseComponent implements OnInit {

  /* Array filled with available courses a student can take. Angular Material list on
  *   html side uses this array to display the courses to the user. */
  availableCourses: string[] = [];
  coursesSelected: string[] = [];

  constructor(private courses: CourseService, private router: Router) {}

  ngOnInit() {
    this.fillAvailableCoursesArray();
  }

  /* To be called when the data is updated in order to update the table without refreshing the page. */
  onRefreshAddCourse() {
    this.fillAvailableCoursesArray();
  }

  /* availableCourses array is going to be filled with available courses a student can take.
  *   courses service is going to be used to retrieve the information. */
  fillAvailableCoursesArray(): void {
    this.courses.getAvailableCourses().subscribe((data: any) => {
      this.setAvailableCourses(data.courses);
    });
  }

  /* Assigning value to the selected courses array to be ready sent to server. */
  setAvailableCourses(value: string[]) {
    this.availableCourses = value;
  }

  /* Sending the selected courses to the server. */
  addCourses(value: any): void {
    /* Confirmation required if the add courses button is pressed. */
    const result = confirm('Do you want to add selected course/s');
    /* If user wants to proceed by pressing yes button on confirmation window. */
    if (result === true) {
      /* Size of the selected courses list. */
      const size = value.selected.length;
      /* Filling the array with the selected courses to send to the server */
      for (let i = 0 ; i < size ; i++) {
        /* expression on the right hand side of the equal operator returns the text of
        *   the selected rows. */
        this.coursesSelected[i] = value.selected[i]._text.nativeElement.innerText;
      }
      /* Response from the server. */
      this.courses.sendCoursesToBeAdded(this.coursesSelected).subscribe((data: any) => {
        if (data.message === 'success') {
          alert('Courses added successfully.');
          /* When this method is called, the table is refreshed without refreshing the page. */
          this.onRefreshAddCourse();
        }
      });
    }
  }

}
