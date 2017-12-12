import { Component, OnInit } from '@angular/core';
import { ApiService } from '../api-service.service';

let parsingMessage = false;
let subject = '';

@Component({
  selector: 'app-email-form',
  templateUrl: './email-form.component.html',
  styleUrls: ['./email-form.component.css']
})
export class EmailFormComponent implements OnInit {

  constructor(public apiService: ApiService) { }

  onChange(event) {

  this.generateMessage(event.target.files).then((data)=>{
    this.submitMessageData(data);
  });
  }

  generateMessage(file) {

    let reader = new FileReader();
    let text;
    let generateMessage = this;
    let message = {};

   return new Promise(function(resolve, reject) {

  reader.onload = function(e) {
    text = reader.result;

    let lines = text.split('\n');

    for(var i = 0; i < lines.length; i++){

      generateMessage.findSingleLineValue(lines[i], message, 'To:');
      generateMessage.findSingleLineValue(lines[i], message, 'From:');
      generateMessage.findSingleLineValue(lines[i], message, 'Date:');
      generateMessage.findSingleLineValue(lines[i], message, 'Message-ID:');
      generateMessage.findMultiLineValue(lines[i], message, 'Subject:');

     }
     message['subject'] = subject;
     console.log(message);
     resolve( message );
  }

  reader.readAsText(file[0]);

   });
  }

  findMultiLineValue(line, message, value) {
    let isSubjectLine = false;
    if (line.indexOf(value) === 0) {
        subject = line.slice(line.indexOf(':') + 1).trim();
        parsingMessage = true;
        isSubjectLine = true;
    }

    if (parsingMessage && (line.indexOf(":") < 0)) {
      subject += (line);
    } else if(!isSubjectLine) {
      parsingMessage = false;
    }
  }

  findSingleLineValue(line, message, value) {
    if(line.indexOf(value) === 0) {
      var foundLine = line.slice(line.indexOf(':') + 1);
      foundLine= foundLine.slice(line.indexOf('<') + 1, line.indexOf('>')).replace(/(^[ \t]*\n)/gm, "").trim();
      message[value.slice(0, value.indexOf(':')).toLowerCase()] = foundLine;
    }
    return message;
  }

  submitMessageData(data) {
    this.apiService.postEmail(data).subscribe((data)=> {

      //TODO redo this to refresh the component not the entire page refresh.  This is a temporary fix in order to complete the project on time
      location.reload();
    })
  }
  ngOnInit() {}
}
