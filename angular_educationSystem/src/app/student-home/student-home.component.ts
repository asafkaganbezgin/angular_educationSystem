import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import {AppComponent} from '../app.component';

@Component({
  selector: 'app-student-home',
  templateUrl: './student-home.component.html',
  styleUrls: ['./student-home.component.css']
})
export class StudentHomeComponent implements OnInit {

  constructor(private router: Router, private nav: AppComponent) {
    this.nav.setDisplayNav(true);
  }

  ngOnInit() {
    this.router.navigate(['student-home/showGrades']);
  }
}
