import { Component, OnInit } from '@angular/core';
import { AuthorizationService } from '../services/authorization-service';
import { User } from '../model/user';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login-form',
  templateUrl: './login-form.component.html',
  styleUrls: ['./login-form.component.css']
})
export class LoginFormComponent implements OnInit {

  /* Creating an object formUser to process the login form inputs. */
  formUser: User = new User();

  listUserArray: User[] = null;

  /* In order to use AuthorizationService class and Router class, constructor
  *   is defined as below. */
  constructor(private auth: AuthorizationService, private router: Router) {
  }

  ngOnInit() {}

  /* Checks if the input fields are empty or an undefined input is given
  *   by the user. If so, window alert is displayed. */
  isValid(): boolean {
    const mail = this.formUser.email;
    const password = this.formUser.password;

    if (mail === '' || typeof mail === 'undefined') {
      alert('Please check your email address');
      return false;
    } else if (password === '' || typeof password === 'undefined') {
      alert('Please check your password');
      return false;
    }
    return true;
  }

  /* onClickMe() method is called if the login button has hit. Method gets a
  *   JSON file and necessary controls are made to navigate through right home
  *   pages for users.  */
  onClickMe() {
    if (this.isValid()) {
      /* Getting back the user credentials from database. */
      this.auth.loginUser(this.formUser).subscribe((user: User) => {
        /* If the user is null, it means the credentials are entered incorrectly
        *   or there is no such user in the system. */
        if (user == null) {
          alert('Please check your email and password');
        } else {
          /* Setting the variables of authorization-service about user like id, name, surname, ...etc  */
          this.auth.setId(user.id);
          this.auth.setName(user.name);
          this.auth.setSurname(user.surname);
          this.auth.setEmail(user.email);
          this.auth.setPassword(user.password);
          this.auth.setGroup(user.group);
          /* Setting isLoggedIn variable to true since the user has a valid account
          *   in the system and had given correct credentials.  */
          this.auth.setIsLoggedIn(true);
          /* Navigating through corresponding homepages for users. */
          if (user.group === 'Student') {
            return this.router.navigate(['/student-home']);
          } else if (user.group === 'Teaching Assistant') {
            return this.router.navigate(['/teaching-assistant-home']);
          } else if (user.group === 'Instructor') {
            return this.router.navigate(['/instructor-home']);
          }
        }
      });
    }
  }
}
