controller=app/controller/
model=app/model/

public:
	vim -p public/index.php public/main.css
core:
	vim -p $(wildcard app/core/*.php)
login:
	vim -p $(controller)LoginController.php $(wildcard app/view/login/*.php) $(model)LoginModel.php
workout:
	vim -p $(controller)WorkoutController.php $(wildcard app/view/workout/*.php) $(model)WorkoutModel.php
sql:
	mysql -u oblig oblig < sql.sql
