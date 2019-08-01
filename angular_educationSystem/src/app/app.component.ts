import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'Education System';
  /* In order to prevent navigation bar from refreshing, we keep a boolean variable
  *   and corresponding set & get method later to be changed. */
  displayNav = false;
  setDisplayNav(value: boolean) {
    this.displayNav = value;
  }
  getDisplayNav(): boolean {
    return this.displayNav;
  }
}
