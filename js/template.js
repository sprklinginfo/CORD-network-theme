/*FILE: template.js
*DESCRIPTION: Browser-side template functions
*/
// <!-- hide script from old browsers

var titledefault;
var descriptiondefault;

function saveVars() {
	if (document.getElementById("title"))
	{
		titledefault = document.getElementById("title").value;
	}
	if (descriptiondefault = document.getElementById("description"))
	{
		descriptiondefault = document.getElementById("description").value;
	}
	if (document.getElementById("workspace-submit"))
	{
		disableSubmit();
	}
}

window.onload = saveVars;

/* helper check if string is url or not */
function isUrl(s){
	var testFor =new Array("http","https","ftp","ftps",".com",".net",".org",".edu",".gov",".int",".mil",".biz",".info",".jobs",
	".mobi",".name","@");
	for (i=0;i<testFor.length;i++)
	{
	 	if (s.indexOf(testFor[i])!= -1)
	 	{
	 		return true;
	 	}
	}
	return false;
}

/* validate the title of workspace */
function checkTitle(){
	var title = document.getElementById("title").value;
	
	if (isUrl(title))
	{
		alert('Do not enter a URL here. Instead, just enter what you would like to call your collaborative Workspace.');
		document.getElementById("title").value = window.titledefault;
	}
	else if (title.indexOf('/') > -1)
	{
		alert('Your site title cannot contain any of these characters: "/".');
		document.getElementById("title").value = window.titledefault;
	}
	else if (title.length > 50)
	{
		alert('Sorry, the text you entered is too long.');
		document.getElementById("title").value = window.titledefault;
	}
	else if (title.length < 1 || title == '')
	{
		disableSubmit();
	}
	else
	{
		title = title.trim().replace(/\s{2,}/g, '-').replace(/\s+/g, '-').toLowerCase();
		document.getElementById("url-title").innerHTML = title;
	}
	enableSubmit();
}

/* validate the description of workspace */
function checkDescription(){
	var description = document.getElementById("description").value;
	if (isUrl(description))
	{
		alert('Do not enter a URL here. Instead, just enter how you would like to describe your collaborative workspace.');
		document.getElementById("description").value = window.descriptiondefault;
	}
	else if (description.length > 75)
	{
		alert('Sorry, the text you entered is too long.');
		document.getElementById("description").value = window.descriptiondefault;
	}
	else if (description.length < 1 || description == '')
	{
		disableSubmit();
	}
	enableSubmit();
}

function enableSubmit() {
	var title = document.getElementById("title").value;
	var description = document.getElementById("description").value;
	if (title && description && title.length > 1 && description.length > 1 && title != '' && description != '')
	{
		document.getElementById("workspace-submit").disabled=false;
		document.getElementById("workspace-submit").className = "";
		document.getElementById("workspace-submit").className = "button orange"
	}
}

function disableSubmit() {
	document.getElementById("workspace-submit").disabled=true;
	document.getElementById("workspace-submit").className = "";
	document.getElementById("workspace-submit").className = "no-styling"
}

// end hiding script from old browsers -->