import { Component, OnInit } from '@angular/core';
import { AuthorizationService } from '../services/authorization-service';

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

  constructor(private auth: AuthorizationService) { }

  ngOnInit() {
    this.storeRoles();
  }

  /* Process the data retrieved from the backend. */
  storeRoles() {
    this.auth.getRoles().subscribe((data: any) => {
      this.rolesArray = data.roles;
    });
  }
}

