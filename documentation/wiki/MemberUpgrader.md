# MemberUpgrader

------

*Please note https is required for ALL API requests.* 

------

**Please note, in API endpoints we pass the "Club Key" as "club_secret"**

*(Club Key can be found in business settings->Business Info->Advanced)*

------


## METHODS

|Method|URL|Info|URL-params|
|---|---|---|---|
|PUT|/api/v1/club/12345/member/12345/changetoemployee|Update the member and returns the member updated (See *STRUCTURE*)|api_key, club_secret|


## PUT Example

The PUT request allows to update an existing member.

* PUT ``/api/v1/club/<club_id>/member/<member_id>/changetoemployee`` would update an existing member with the given ``member_id``.

|Field|Type|Optional|Values|Information|
|---|---|---|---|---|
|add_priviliges|array|no| |The priviliges the new employee will have. Default priviliges is added by default


#### Supported Priviliges

|API Value|Virtuagym role|
|---|---|
|'club_manager' | Club manager|
|'assistent_manager' | Assistant manager|
|'marketing_manager' | Marketing manager|
|'coach' | Coach|
|'financial' | Financial|
|'employee' | Employee|
|'scheduling' | Scheduling|
|'default' | Default, added for each employee|


### Updating a Member
Send a PUT request to `https://virtuagym.com/api/v1/club/<club_id>/member/<member_id>/changetoemployee?api_key=<api_key>&club_secret=<club_key>` with the following body.

```json
{
"add_priviliges":["coach"]
}
```

And corresponding, the fields would now be updated while returning a response as follows

```json
{
  "status": {
    "statuscode": 200,
    "statusmessage": "Everything OK",
    "result_count": 10,
    "timestamp": 1439303936123
  },
  "result": {
        "member_id": 138,
        "firstname": "John",
        "lastname": "Doe",
        "email": "John+Doe@domain.eu",
        "active": true,
        "gender": "f",
        "member_since": 0,
        "timestamp_edit": 1526646125115,
        "birthday": "1914-02-01",
        "lang": "nl",
        "country": "NL",
        "club_id": 377,
        "registration_date": 1383054083,
        "is_pro": false,
        "is_employee": 1,
        "priviliges": "default,coach"
  }
}
```

*Note* If the member does not belong to the club the below response is expected 
<pre>
<code class="json">
{
  "statuscode": 420,
  "statusmessage": "No member found.",
  "result_count": 0,
  "timestamp": 1439302743
}
</code>
</pre>

## Possible error codes and messages


|Statuscode|Message|Description|
|---|---|---|
|200|Everything OK|Everything proceeded according to the specifications|
|420|No member found|Member does not belong to the club or member does not exist|
|420|Member is an already an employee|The member is an already an employee. If you want to update the Employee please make use of the Employee API 

