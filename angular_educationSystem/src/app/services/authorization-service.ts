import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { User } from '../model/user';

@Injectable({
  providedIn: 'root'
})
export class AuthorizationService {

  /* Variable to check if the user is already logged in or not. */
  private isLoggedIn = false;
  /* User variables to store. */
  private id;
  private name;
  private surname;
  private email;
  private password;
  private group;

  constructor(private httpClient: HttpClient) {}

  /* Posting user inputs to php side to make necessary controls in the backend. */
  loginUser(user: User): Observable<User> {
    return this.httpClient.post<User>('http://localhost/educationSystem/api/loginService.php', {
      mail: user.email,
      pass: user.password
    }, {});
  }

  /* Get the roles of the logged in user. */
  getRoles(): Observable<object> {
    return this.httpClient.post<object>('http://localhost/educationSystem/api/get-roles.php', {
      id: this.id,
      group: this.group
    });
  }

  /* Set methods for private variables of this class. */
  setIsLoggedIn(value: boolean) {
    this.isLoggedIn = value;
  }
  setId(value: number) {
    this.id = value;
  }
  setName(value: string) {
    this.name = value;
  }
  setSurname(value: string) {
    this.surname = value;
  }
  setEmail(value: string) {
    this.email = value;
  }
  setPassword(value: string) {
    this.password = value;
  }
  setGroup(value: string) {
    this.group = value;
  }

  /* Get methods for private variables of this class. */
  getIsLoggedIn() {
    return this.isLoggedIn;
  }
  getId() {
    return this.id;
  }
  getName() {
    return this.name;
  }
  getSurname() {
    return this.surname;
  }
  getEmail() {
    return this.email;
  }
  getPassword() {
    return this.password;
  }
  getGroup() {
    return this.group;
  }

}
