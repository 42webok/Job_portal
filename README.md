🧑‍💼 Job Portal – Laravel Project

A complete Job Portal Web Application built with Laravel that allows employers to post jobs and candidates to apply online.

🚀 Features
👤 Authentication

User Registration & Login

Employer Registration & Login

Password Reset

Profile Management

🏢 Employer Panel

Post New Jobs

Edit / Delete Jobs

View Applicants

Manage Company Profile

👨‍💻 Candidate Panel

Browse Jobs

Search & Filter Jobs

Apply for Jobs

Upload Resume

Edit Profile

🛠 Admin Panel

Manage Users

Manage Employers

Manage Jobs

Approve / Reject Job Posts

Dashboard Statistics

🏗 Built With

Laravel

PHP

MySQL

Bootstrap / CSS

JavaScript / jQuery

CropperJS (for profile image upload)

📂 Project Installation
1️⃣ Clone Repository
git clone https://github.com/your-username/job-portal.git

2️⃣ Go to Project Folder
cd job-portal

3️⃣ Install Dependencies
composer install

4️⃣ Copy .env File
cp .env.example .env

5️⃣ Generate App Key
php artisan key:generate

6️⃣ Configure Database

Update .env file:

DB_DATABASE=job_portal
DB_USERNAME=root
DB_PASSWORD=

7️⃣ Run Migrations
php artisan migrate


(Optional if you have seeders)

php artisan db:seed

8️⃣ Run Project
php artisan serve


Open in browser:

http://127.0.0.1:8000