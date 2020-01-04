controller=app/controller/
model=app/model/

public:
	vim -p public/index.php public/main.css
core:
	vim -p $(wildcard app/core/*.php)
login:
	vim -p $(controller)login_controller.php $(wildcard app/view/login/*.php) $(model)login_model.php
workout:
	vim -p $(controller)workout_controller.php $(wildcard app/view/workout/*.php) $(model)workout_model.php
sql:
	mysql -u oblig oblig < sql.sql
