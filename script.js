function adminBlock()
{
  alert("To Search First and Foremost you have to Login");
  window.open("login.html");
//   for(var i=0;i<4;i++)
// {
//   var password = prompt("Enter in the password");
//         if (password=="1234" && i<4) 
//         {
//           window.open("admin.html");
//         }
//         else 
//         {
//           tempAlert("Enter Again, Its Wrong, you have tried 4 times.",1000);
//         }
// }
}
function login() //llogin.html
{
 
   window.open("login.html");
   
}
//sign up.html
function SignUP()
{
  window.open("signUP.html");

}

function buttonPress()
{
 var name=" ";

 let length;
 start:
  name=document.getElementById("input1").value;
if(name.length>=40)
{
tempAlert("Your Name length is More than 40 characters", 1000);
  document.getElementById("input1").value='';
  name=" ";
  repeat:  start;
}
}
function buttonPress2()
{
 var email=" ";

 let length;
 start:
  email=document.getElementById("email").value;
if(email.length>=80)
{
  tempAlert("Your Email length is More than 80 characters", 1000);
  document.getElementById("email").value='';
  email=" ";
  repeat:  start;
}
}
function buttonPress3() //this will be modified more
{ var password=" ";

let length;
start:
 password=document.getElementById("passwordID").value;
if(password.length>=40)
{
  tempAlert("Your Password length is More than 40 characters", 1000);
 document.getElementById("passwordID").value='';
 password=" ";
 repeat:  start;
}}
function tempAlert(msg,duration) {
     var el = document.createElement("div");
     el.setAttribute("style","padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;position:absolute;top:20%;left:38%;background-color:white; border-radius: 12px;opacity:0.5;");
     el.innerHTML = msg;
     setTimeout(function(){
      el.parentNode.removeChild(el);
     },duration);
     document.body.appendChild(el);
 }

