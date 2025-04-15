# 🎬 Vintage Movie Admin Panel

A responsive PHP-based Movie Admin Dashboard that allows authenticated admin users to manage a database of movies. Built with MySQL, Bootstrap 5, and vanilla JavaScript.

## 🔐 Features

- **Admin Authentication** (Login/Logout using sessions)
- **Movie Management**
  - View paginated list of movies
  - Add/Edit/Delete movie entries
- **Admin User Management**
  - Only existing admins can add/edit/delete other admins
- **Studio Information**
  - Each movie is associated with a studio
- **Language Parsing**
  - Displays full language name based on language code
- **Responsive UI**
  - Fully responsive for mobile, tablet, and desktop using Bootstrap
- **View Movie Details**
  - Modal pop-up showing additional details and studio information
- **Image upload**
  - When an admin adds a movie, an image of the movie is also uploaded.
  

## 🧰 Tech Stack

- **Frontend**: HTML, Bootstrap 5, CSS, JavaScript
- **Backend**: PHP (Session-based auth)
- **Database**: MySQL

## 📁 Project Structure

```
├── index.php               # Public-facing movie list
├── login.php               # Admin login page
├── authenticate.php        # Processes login form
├── logout.php              # Destroys session
├── adminnav.php            # Navbar for admin panel
├── adminpanel.php          # Dashboard for admin users
├── connection.php          # MySQL DB connection
├── addmovie.php            # Form to add new movie
├── editmovie.php           # Form to update movie info
├── deletemovie.php         # Deletes a movie from the DB
├── styles/
│   └── styles.css          # Custom styling
├── js/
│   └── script.js           # Handles modal and DOM interactions
└── db/
    └── movies.sql          # Database schema and seed data
```

## ⚙️ Setup Instructions

1. **Clone this repo**

```bash
git clone https://github.com/awsactivators/php-cms-assignment2.git
```

2. **Setup MySQL Database**
- Import the `movies.sql` file into your MySQL server
- Update `connection.php` with your DB credentials

```php
$connect = mysqli_connect("localhost", "root", "your_password", "movie_db");
```

3. **Start a PHP Server**

```bash
php -S localhost:8000
```
Then visit `http://localhost:8000`

4. **Login as Admin**
- Visit `/login.php`
- Use pre-registered admin credentials from your database


## 📦 Future Improvements

- Add search/filter functionality
- Role-based permissions
- API endpoints for CRUD

---

Feel free to customize the UI and functionality to fit your own use case.
