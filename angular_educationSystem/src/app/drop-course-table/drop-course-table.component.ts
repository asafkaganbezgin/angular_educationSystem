import { SelectionModel } from '@angular/cdk/collections';
import { Component, OnInit } from '@angular/core';
import { CourseService } from '../services/course.service';
import {Router} from '@angular/router';

export interface ICourses {
  course: string;
}

@Component({
  selector: 'app-drop-course-table',
  templateUrl: './drop-course-table.component.html',
  styleUrls: ['./drop-course-table.component.css']
})
export class DropCourseTableComponent implements OnInit {

  displayedColumns: string[] = ['select', 'course'];
  /* An empty array is initialized because angular gives an error even if the dataSource
  *   variable is filled with something. Because if ve don't initialize an empty array,
  *   later in the code, if the dataSource.length is called, since ngOnInit works asynchronous
  *   angular gives an error saying length is undefined */
  dataSource: any[] = [];
  selection = new SelectionModel<ICourses>(true, []);
  /* Number of rows selected.*/
  numRowSelected: number;

  constructor(private courses: CourseService, private router: Router) {
    this.dataSource = [];
  }

  ngOnInit() {
    this.getCourses();
  }

  onRefreshDropCourses() {
    this.getCourses();
    this.numRowSelected = 0;
  }

  /* Whether the number of selected elements matches the total number of rows. */
  isAllSelected() {
    if (this.dataSource !== undefined) {
      const numSelected = this.selection.selected.length;
      const numRows = this.dataSource.length;
      return numSelected === numRows;
    }
  }

  /* Selects all rows if they are not all selected; otherwise clear selection. */
  masterToggle() {
    this.isAllSelected() ?
      this.selection.clear() :
      this.dataSource.forEach(row => this.selection.select(row));
  }

  /* The label for the checkbox on the passed row */
  checkboxLabel(row?: ICourses): string {
    if (!row) {
      return `${this.isAllSelected() ? 'select' : 'deselect'} all`;
    }
    return `${this.selection.isSelected(row) ? 'deselect' : 'select'} row ${row.course + 1}`;
  }

  /* Setting the value of dataSource variable with the observable retrieved from backend. Containing the
   *  courses which the logged in user takes. */
  getCourses(): void {
    this.courses.getCourses().subscribe((data: any) => {
      this.setCourses(data.course);
    });
  }

  /* Get the value of the selected row. */
  getSelectedRowAmount(): void {
    this.numRowSelected = this.selection.selected.length;
  }

  /* If no rows are selected, button going to be disabled. Method returns boolean
  *   expression to determine that. */
  isAnySelected(): boolean {
    if (this.numRowSelected === 0) {
      return false;
    } else if (this.numRowSelected > 0) {
      return true;
    }
  }

  /* Storing the courses to be deleted. */
  sendCourses(): void {
    const confirmation = confirm('Are you sure to drop course/s selected?');
    if (confirmation === true) {
      this.courses.sendCourses(this.selection.selected).subscribe((data: any) => {
        if (data.message === 'success') {
          alert('Course/s deleted successfully.');
          this.onRefreshDropCourses();
        }
      });
    }
  }

  /* Setting the dataSource variable. */
  setCourses(value: any): void {
    this.dataSource = value;
  }

}
