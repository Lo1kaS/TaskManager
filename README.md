My implementation of the Task Manager


- ☑️ Install [Node.js](https://nodejs.org/en/download/)
- ☑️ Install [Git](https://git-scm.com/downloads)
- ☑️ Install [Visual Studio Code](https://code.visualstudio.com/download)
- ☑️ Install [Laravel](https://laravel.com/docs/9.x/installation)
- ☑️ Install [Composer](https://getcomposer.org/download/)


1. Clone the repository
```bash
git clone https://github.com/Lo1kaS/TaskManager
```
2. Install dependencies
```bash
composer install
```
3. Create a copy of your .env file
```bash
cp .env.example .env
```
4. Generate an app encryption key
```bash
php artisan key:generate
```
5. Create an empty database for our application
6. In the .env file, add database information to allow Laravel to connect to the database, for example:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```
7. Migrate the database
```bash
php artisan migrate
```
8. Run the server
```bash
php artisan serve
```
9. Visit [http://localhost:8000](http://localhost:8000) to see the application in action


##TODO
- ☑️ Add a task status
- ❌ Add a task priority
- ❌ Add a task deadline
- ❌ Add a task description
- ☑️ Add a task edit page
- ☑️ Make GET API
- ☑️ Make POST API
- ☑️ Make PUT API
- ☑️ Make DELETE API
Preview

![image](https://user-images.githubusercontent.com/71433614/219157240-c0c6e30e-6628-4e26-bd9e-c2bd1f588c76.png)

![image](https://user-images.githubusercontent.com/71433614/219157331-48232e1c-4677-4dc3-a0db-dd3c16886d14.png)


![image](https://user-images.githubusercontent.com/71433614/219157387-5b09acbe-95ee-44c0-89fd-d5fd726c23aa.png)

![image](https://user-images.githubusercontent.com/71433614/219157450-435b6f1a-f71d-4d5d-8c6d-777ba1679d7b.png)

![image](https://user-images.githubusercontent.com/71433614/219157517-5a21956f-aa8b-4994-83f7-d0b2501cf762.png)

