import { Component, OnInit } from '@angular/core';
import { AuthorizationService } from '../services/authorization-service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-nav-bar',
  templateUrl: './nav-bar.component.html',
  styleUrls: ['./nav-bar.component.css']
})
export class NavBarComponent implements OnInit {

  private userGroup = this.auth.getGroup();
  private userName = this.auth.getName();
  private userSurname = this.auth.getSurname();

  rolesArray: string[];

  constructor(private auth: AuthorizationService, private router: Router) { }

  ngOnInit() {
    this.storeRoles();
  }

  /* Process the data retrieved from the backend. */
  storeRoles() {
    this.auth.getRoles().subscribe((data: any) => {
      this.rolesArray = data.roles;
    });
  }

  /* Navigating with the links on the nav bar. */
  onClick($event): void {
    if ( $event.toElement.innerText === 'Join Course') {
      this.router.navigate(['/student-home/addCourse']);
    } else if ($event.toElement.innerText === 'Drop Course') {
      this.router.navigate(['/student-home/dropCourse']);
    } else if ($event.toElement.innerText === 'Show Grades') {
      this.router.navigate(['/student-home']);
    }
  }
}

