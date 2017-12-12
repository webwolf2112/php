import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent implements OnInit {

  title = 'Vanessa Henson Return Path Developer';
  subtitle = `Here's the code to prove it`;

  constructor() { }

  ngOnInit() {
  }

}
