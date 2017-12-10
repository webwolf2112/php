import { Injectable } from '@angular/core';
import { Http, Response } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/map';

@Injectable()
export class ApiService {
  $url = `http://localhost:90/`;

  constructor (
    private http : Http
  ) {}

  getEmails() {

  return this.http.get(this.$url)
   .map((res:Response) => res.json());
 }

 // postEmails() {
 //   this.http.post()
 // }

}
