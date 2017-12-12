import { Component, OnInit } from '@angular/core';
import { ApiService } from '../api-service.service';

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

  this.generateMessage(event.target.files).then((data)=>{

    // console.log(data);
    this.submitMessageData(data);
    console.log('message callback');
  });

  //console.log(message);
  //console.log(this.$emailMessage);

  //Post Email Message


  }

  generateMessage(file) {

    var reader = new FileReader();
    let text;
    let generateMessage = this;
    let message = {};
    let subject = '';
    let subjectCount = 0;

   return new Promise(function(resolve, reject) {

  reader.onload = function(e) {
    text = reader.result;

    let lines = text.split('\n');

    for(var i = 0; i < lines.length; i++){

      generateMessage.findSingleLineValue(lines[i], message, 'To:');
      generateMessage.findSingleLineValue(lines[i], message, 'From:');
      generateMessage.findSingleLineValue(lines[i], message, 'Date:');
      generateMessage.findSingleLineValue(lines[i], message, 'Message-ID:');
      generateMessage.findSingleLineValue(lines[i], message, 'Subject:')
      //subject = that.findMultiLineValue(lines[i], 'Subject:', subject, subjectCount);

     }

    // message['subject'] = subject;
     //console.log(message);
     resolve( message );
  }

  reader.readAsText(file[0]);

   });
  }

  findMultiLineValue(line, value, multiString, countLine) {
    if(countLine === 0) {
      console.log(line.indexOf('Subject:'));
      if(line.indexOf(value) > -1) {
        var foundLine = line.slice(line.indexOf(':') + 1).trim();
        multiString += foundLine;
        countLine ++;
      }
    } else {
      if(line.indexOf(":") < 0 ) {
        multiString += (" " + line);
      }
    }
      return multiString;
  }

  findSingleLineValue(line, message, value) {
    if(line.indexOf(value) > -1) {
      var foundLine = line.slice(line.indexOf(':') + 1);
      foundLine= line.slice(line.indexOf('<') + 1, line.indexOf('>')).replace(/(^[ \t]*\n)/gm, "").trim();
      message[value.slice(0, value.indexOf(':')).toLowerCase()] = foundLine;
    }
    return message;
  }

  submitMessageData(data) {
    this.apiService.postEmail(data).subscribe((data)=> {
      console.log(data.return_message);
      // console.log(data.post_var);
      console.log(data.email);

      //TODO redo this to refresh the component not the entire page refresh
      location.reload();
    })
  }
  ngOnInit() {}

}
