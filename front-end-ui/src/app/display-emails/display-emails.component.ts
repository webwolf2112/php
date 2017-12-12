import { Component, OnInit } from '@angular/core';
import { ApiService } from '../api-service.service';

@Component({
  selector: 'app-display-emails',
  templateUrl: './display-emails.component.html',
  styleUrls: ['./display-emails.component.css']
})
export class DisplayEmailsComponent {
  emails = [];

  toHTML(input) : any {
    return new DOMParser().parseFromString(input, "text/html").documentElement.textContent;
  }

  constructor(public apiService: ApiService) {}

  ngOnInit(){
       this.apiService.getEmails().subscribe(data => this.emails = data.return_data);
   }
}
