# Panda-team
Developer test task from panda-team

# Prerequisites
The project was made for educational purposes. It is designed to demonstrate skills in OO-programming. Many details and implementations are intentionally omitted.

# Description
The application is a home page with fake surveys. It has login, registration and one API endpoint.

# Usage
1. Go to homepage
2. Register a user
3. Login into your cabinet
4. Сreate fake surveys
5. Receive a random survey with API for a registered user:
    - request example: http://domain/api/getrandomsurvey?email=email&password=password
    - response example: {"Some question 1":[{"answer":"Some answer 1","votes":"1"},{"answer":"Some answer 2","votes":"2"}]}
