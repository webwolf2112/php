import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-display-emails',
  templateUrl: './display-emails.component.html',
  styleUrls: ['./display-emails.component.css']
})
export class DisplayEmailsComponent implements OnInit {
  emails = [
    {
      to: 'vanessa@vanessa.com',
      from: 'chris@chris.com',
      messageId: '1234abcd',
      subject: 'This is the subject',
      date: '09 09 1977',
    },
    {
      to: 'kellee@kellee.com',
      from: 'brandon@brandon.com',
      messageId: '1234abcd',
      subject: 'This is Literally an Email',
      date: '02 01 1990',
    }
  ]

  constructor() { }

  ngOnInit() {
  }

}
