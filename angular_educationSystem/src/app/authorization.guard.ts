import { Injectable } from '@angular/core';
import { CanActivate, Route, UrlSegment, ActivatedRouteSnapshot, RouterStateSnapshot, UrlTree, Router } from '@angular/router';
import { Observable } from 'rxjs';
import { AuthorizationService } from './services/authorization-service';

@Injectable({
  providedIn: 'root'
})
export class AuthorizationGuard implements CanActivate {

  constructor(private auth: AuthorizationService, private router: Router) {
  }

  /* If user is not logged in, locks the homepages and redirect user back to login page. */
  canActivate(
    next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
    if (!this.auth.getIsLoggedIn()) {
      const ifEntered = this.router.navigate(['/login']);
    }
    return this.auth.getIsLoggedIn();
  }
}
