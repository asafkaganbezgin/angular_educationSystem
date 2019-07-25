import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { AuthorizationService } from './authorization-service';

@Injectable({
  providedIn: 'root'
})
export class GradesService {

  constructor(private httpClient: HttpClient, private auth: AuthorizationService) { }

  getGrades(): Observable<object> {
    return this.httpClient.post<object>('http://localhost/educationSystem/api/get-grades', {
      id: this.auth.getId()
    }, {});
  }
}
