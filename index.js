var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var fs = require("fs");
var pretext;
// Asynchronous read 
fs.readFile('log.txt', function (err, data) { 
   if (err) { 
       return console.error(err); 
   } 
   console.log("Asynchronous read: " + data.toString()); 
   pretext = data.toString().split(";");
   for (p in pretext){
   	console.log(">"+pretext[p]);
   	
   }
   io.emit('send data', pretext);
});  
// Synchronous read 
var data = fs.readFileSync('input.txt'); 
console.log("Synchronous read: " + data.toString());  
console.log("Program Ended"); 
var front = data.toString()

app.get('/', function(req, res){

  	res.sendfile('index3.html');
});


io.on('connection', function(socket){
  socket.on('chat message', function(msg){
    io.emit('chat message', front+msg);
    logit(msg+"\n")
  });
socket.on('send data', function(msg){
		  fs.readFile('log.txt', function (err, data) { 
		   if (err) { 
		       return console.error(err); 
		   } 
		   console.log("Asynchronous read: " + data.toString()); 
		   pretext = data.toString().split("|");
		   for (p in pretext){
		   	console.log(">"+pretext[p]);
		   	
		   }
		   io.emit('send data', pretext);
		}); 
 });

});

http.listen(3000, function(){
  console.log('listening on *:3000');
});

function logit(logmsg){
	fs.appendFile('log.txt', logmsg,function (err) { 
   if (err) { 
       return console.error(err); 
   } 
   console.log("Asynchronous read: " + data.toString()); 
}); 
}
