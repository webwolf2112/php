import { Component, OnInit } from '@angular/core';
import { ApiService } from '../api-service.service';
declare var mailparser: any;

@Component({
  selector: 'app-email-form',
  templateUrl: './email-form.component.html',
  styleUrls: ['./email-form.component.css']
})
export class EmailFormComponent implements OnInit {
  $emailMessage = {
    to: 'posttest@posttest.com',
    from: 'angular@email.com',
    subject: 'this is a test test test test',
    date: 'Fri,  1 Apr 2011 06:52:55 -0600 (MDT)',
    message_id: 'Corel.6k3yh-636g-.fv4t@email1-corel.com'
  };


  constructor(public apiService: ApiService) { }

  onChange(event) {

  let message = this.generateMessage(event.target.files);

  //Post Email Message
  this.submitMessageData(message);

  }

  generateMessage(file) {
    var formData = new FormData();
    console.log(file);
    formData.append("file", file[0], file[0].filename);
    console.log(file[0]);
    console.log(file[0].name);
    console.log(file[0].mimetype);

    return formData;
  }

  submitMessageData(data) {
    this.apiService.postEmail(data).subscribe((data)=> {
      console.log(data.return_message);
      console.log(data.post_var);
      console.log(data.email)
    })
  }
  ngOnInit() {}

}
