import { Injectable } from '@angular/core';
import { Http, Response, Headers, RequestOptions } from '@angular/http';
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

 postEmail($emailMessage) {
   let headers = new Headers();
   headers.append('Content-Type', 'multipart/form-data; charset=utf-8');
   headers.append('Accept', 'application/json');

  let options = new RequestOptions({ headers: headers });

  return this.http.post(this.$url, $emailMessage, options)
    .map((res:Response) => res.json());
 }

}
