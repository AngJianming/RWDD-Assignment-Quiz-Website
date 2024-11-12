# Quiz-Website for Asia Pacific Univerisity (APU) Resposive Web Design & Development Assessment

## Project outline
1. Landing Page
	- /landingPage.php
<br><br>

1. Login / OAuth2.0 / Registration page
	- /Login/login.php
	- /Login/oauth.php (Will automatically have a design that allows users to use Open Authentication 2.0)
	- /Login/register.php
	- Register as a student/lecturer/admin

1. Student Page
	- Student/main/main.php
	- Student/game-src/app.php
	- Student/play/play.php
	- Student/profile/profile.php
	- Student/logout.php
	- Accessible by students after login
	- This is a dashboard for Students where they can explore, attempt a quiz using a code made by educator or join a ranked game.

1. Educator
	- /dashboard/student.php
	- Accessible by students only
	- Display past quiz attempts, results 
	- Total Time spent taking quizzes (sum from all attempts)
	- change password
	- additional information (name, joined date etc)
	
	- /dashboard/lecturer.php
	- Accessible by lecturers only
	- Display created quizzes and average score
	- Option to create more quizzes -> /quiz/create
	- Option to delete quizzes
	- change password
	- additional information (name, joined date etc)

1. Admin Page
	- /analytics.php
	- Only accessable when admin login is successful
	- Average score for question
	- Average score for quiz
	- For mcq only, % of chosen answer and the correct answer is highlighted

### Data dictionary (MySQL Database)

1. questions

| **Attribute Name**  	| **Data Type** | **Nullable**  |	**Key**				|
|	-------------		| ------------	| ------------	|	------------		|
| question_id       	| INT(11)       | No            | [PK] 					|
| question_text     	| TEXT		    | No            |						|
| question_no    	 	| INT(11)		| No            |						|
| correct_answers   	| BOOLEAN	    | No            | 						|
| quiz_id           	| INT(11)       | No            | [FK] custom_quiz		|
| rank_quiz_id			| INT(11)		| No 			| [FK] rank_quiz_levels	|
<br>

2. custom_quiz

| **Attribute Name** 		   | **Data Type** | **Nullable** |	**Key**				|
| ------------------ 		   | ------------- | ------------ |	-------				|
| quiz_id            		   | INT(11)       | No           | [PK] 				|
| quiz_name                    | VARCHAR(100)  | No           |						|
| description        		   | VARCHAR(255)  | Yes          |						|
| public_visibility        	   | BOOLEAN	   | Yes          |						|
| custom_quiz_time_of_creation | DATETIME      | No           |						|
| custom_quiz_last_updated_at  | DATETIME      | No           |						|
| lecturer_id        		   | INT(11)       | No           | [FK] educator table |
**Note**
	- Total attemps are calculated by rows in attempt
<br><br>


3. rank_quiz_levels

| **Attribute Name**   		| **Data Type**   | **Nullable**    |		**Key**			|
| ---------------------		|-----------------|-----------------|	-------				|
| ranked_quiz_id       		| INT(11)         | No              | [PK]					|
| ranked_quiz_name     		| VARCHAR(50)     | No              | 						|
| attempt_duration     		| INT             | No              |						|
| ranked_score		   		| INT             | No              |						|
| difficulty_rating    		| INT             | No              | 						|
| admin_time_of_creation	| DATETIME        | No              |						|
| admin_id	       	   		| INT(11)    	  | No		   	    | [FK] admin table		|
<br>


4. admin

| **Attribute Name** | **Data Type** | **Nullable** |	**Key**	|
| ------------------ | ------------- | ------------ |	-----	|
| admin_id           | INT(11)       | No           | [PK]		|
| admin_username     | VARCHAR(255)  | No           |			|
| admin_password     | VARCHAR(255)  | No           |			|
| admin_DOJ			 | DATETIME      | No           |			|
<br>


5. student

| **Attribute Name** | **Data Type** | **Nullable** |	**Key**		|
| ------------------ | ------------- | ------------ |	--------	|
| student_id         | INT(11)       | No           | [PK]			|
| student_username   | VARCHAR(255)  | No           |				|
| student_password   | VARCHAR(255)  | No           |				|
| student_email      | VARCHAR(255)  | No           |				|
| student_DOJ		 | DATETIME      | No           |				|
<br>


6. educator

| **Attribute Name**  | **Data Type**      | **Nullable** |		**Key**		   |
| ------------------- | ------------------ | ------------ | ------------------ |
| educator_id         | INT(11)            | No           | [PK]               |  
| educator_username   | VARCHAR(50)        | No           |					   |
| educator_password   | VARCHAR(100)       | No           |					   |
| educator_email      | VARCHAR(100)       | No           |					   |
| educator_institution| TEXT		       | No           |					   |
| educator_contacts   | VARCHAR(30)        | No           |					   |
| educator_DOJ 		  | DATE	           | No           |					   |
<br>
**Note**
	- Students and Educators are not the same, they have different interfaces and functionalities.

7. quiz_submission

| **Attribute Name** 		| **Data Type** | **Nullable** |	**Key**		|
| ------------------ 		| ------------- | ------------ |	--------	|
| ranked_quiz_id     		| INT(11)       | No           | [PK, FK]		|
| quiz_id		     		| INT(11) 	    | No           | [PK, FK]		|
| student_id	     		| INT(11)  	    | No           | [PK, FK] 		|
| time_started   			| TIMESTAMP     | No           |				|
| data&duration_submitted   | TIMESTAMP	    | No           |				|

## Contributors
@AngJianming
<br>
@Nexea1221
<br>
@Jayden2305
<br>
@genni1227
<br>
@zhiheng0614