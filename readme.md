# User Data

In this task I am displaying user data fetched from API and can be dump in csv format

The following information is displayed
○ Name <br>
○ Email <br>
○ City <br>
○ Phone. <br>

```shell
index.php is a small bootstrap file that initiate class
```
To get single User replace the below method in view 
```shell
$all_users = $all_user->allUsers(); 
```
With 
```shell
$all_users = $all_user->getUser(); 
```


## Directory Structure
```
| Directory               | Purpose                                     |
|:-----------------------:|:-------------------------------------------:|
| App                     |handles all the logic                        |
| View                    |respond with the corresponding view          |
```

