h1. Status and/or Error-codes

|Statuscode|Message|Description|
|---|---|---|
|200|Everything OK|Everything proceeded according to the specifications|
|401|Authentication Failed|Something went wrong authenticating. If you used Basic HTTP Authentication, it means that either the user and password do not match, or an invalid API key has been submitted. If you used Open Authorization it means that your Oauth Token has not been Authorized. Make sure that it is before requesting access|
|403|Access Disabled|For some reason Virtuagym has disabled access from your consumer. You'll have to contact Virtuagym to enable it again|
|406||Email address already in use|
|404|Resource not found|The API url you specified did not point to a valid resource (i.e., an invalid activity instance number|
|420|Invalid Input|One of the inputs you provided is invalid according to the specifications. The status message shows which value this is|
|421|Too many access attempts|You tried to access the server too many times. You'll have to wait a few minutes to try again|
|427|Missing Oauth Token|The Oauth Token that you have used could not be found on the server. Please register it first|
|428|Invalid access token|Access token is not valid. It has expired or the user has stopped authorisation.|
|430|Event full|(for Club-events) event attendance limit reached|
|431|Can not cancel event booking|(for Club-events) too late to cancel the booking|
|432|Not enough credits.|Can not book this event. User does not have enough credits.|
|450|Too many failed login attempts|Account has been blocked because there have been too many login attempts with a wrong password. Ask the user to logou and login via the website (so the user will be able to do a captcha)|
|500|Internal server error||
|503|Server unavailable|Server is down for maintainance. Retry later|
