# EmployeeDowngrader

------

*Please note https is required for ALL API requests.* 

------

**Please note, in API endpoints we pass the "Club Key" as "club_secret"**

*(Club Key can be found in business settings->Business Info->Advanced)*

------


## METHODS

|Method|URL|Info|URL-params|
|---|---|---|---|
|PUT|/api/v1/club/12345/employee/12345/changetomember|Update the employee and returns the member updated (See *STRUCTURE*)|api_key, club_secret|


## PUT Example

* PUT ``/api/v1/club/<club_id>/employee/<member_id>/changetomember`` would update an existing employee with the given ``member_id`` by downgrading him to a member.

|Field|Type|Optional|Values|Information|
|---|---|---|---|---|

### Updating an Employee
Send a PUT request to `https://virtuagym.com/api/v1/club/<club_id>/employee/<member_id>/changetomember?api_key=<api_key>&club_secret=<club_key>`. No body is required

The returned response is 

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
        "is_employee": 0,
  }
}
```

*Note* If the member does not belong to the club the below response is expected 
<pre>
<code class="json">
{
  "statuscode": 420,
  "statusmessage": "No employee found.",
  "result_count": 0,
  "timestamp": 1439302743
}
</code>
</pre>

## Possible error codes and messages


|Statuscode|Message|Description|
|---|---|---|
|200|Everything OK|Everything proceeded according to the specifications|
|420|No member found|Employee does not belong to the club or employee does not exist|
|420|Already a member|The employee is actually already a member. If you want to update the Member please make use of the Member API 

