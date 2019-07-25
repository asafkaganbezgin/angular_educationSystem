import { Component, OnInit } from '@angular/core';
import { GradesService } from '../services/grades.service';

/* Interface to read the variables from the json file returned from the server. */
export interface IGradeType {
  code: string;
  mtAvg: number;
  quizAvg: number;
  final: number;
  participation: number;
  attendance: number;
  labAvg: number;
  project: number;
}

@Component({
  selector: 'app-grades-table',
  templateUrl: './grades-table.component.html',
  styleUrls: ['./grades-table.component.css']
})
export class GradesTableComponent implements OnInit {

  private displayedColumns: string[] = ['code', 'mtAvg', 'quizAvg', 'final', 'participation',
    'attendance', 'labAvg', 'project'];

  private dataSource;

  constructor(private grade: GradesService) { }

  /* Show grades method called in ngOnInit() function to get the grades
  *   of the student immediately after the login. */
  ngOnInit() {
    this.showGrades();
  }

  /* Show grades method used to fill the table by updating datasource variable
  *   which the table gets the information. */
  showGrades() {
    this.grade.getGrades().subscribe((data: any) => {
      if (data == null) {
        console.log('No grade to show');
      } else {
        this.setDataSource(data.lesson);
      }
    });
  }

  /* Set method for datasource variable. It is required because " = " operator does not work
  *   to set a variable in ngOnInit() function. */
  setDataSource(value: IGradeType[]) {
    this.dataSource = value;
  }
}
