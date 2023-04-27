# PHP Admin Panel for Article Website

This repository contains a basic PHP Admin Panel for an Article Website. The Admin Panel is designed for managing user groups, users, and articles on the website.

## 📃 Pages

The Admin Panel contains the following pages/sections:

1. **Login Page**: Users can log in with their username and password.
2. **Home Page**: The home page includes a sidebar or top bar navigation with the following items: Groups, Users, Articles, and Logout.
3. **Groups Page**: Admin can add, edit, and delete a group. Each group has a Font Awesome icon, name, and description. This page has a table for existing groups and a form to add new groups or edit existing ones. Users can search for a group by name or description.
4. **Users Page**: Admin can add, edit, and delete users. Each user has a name, email, mobile number, username, password, and a group (each user can belong to one group). This page has a table for existing users and a form to add new users or edit existing ones. Users can filter users by group and search for a user by name.
5. **Articles Page**: This page is accessible only to Admins and Editors. An article has a title, summary, image, full article, and publishing date. This page has a table for existing articles and a form to add new articles. Articles cannot be edited.
6. Clicking a group name on the Groups Page opens the Users Page filtered by that group to see its users.

## 💻 Technologies

The Admin Panel is built using the following technologies:

- PHP
- MySQL
- HTML
- CSS
- Bootstrap
- Font Awesome

## ⭐ Features

The Admin Panel includes the following features:

- Remember Me field on Login Page
- My Profile Page of the Logged in User
- Hello message with the date of the user's last visit when logged in
- Soft Delete with a column called is_Deleted in every table that, if true, then the record is deleted without having to actually delete the record.
- Error log files that store all errors in the system in the following format: Date Time, User IP, Browser used, Exception Message, File Name that causes the exception, Line.

## Roles

- Admins: can access all pages/sections
- Editors: can access only the Articles Page

### Bonus Work

- Using any chart library to add a curve between Group name on X axis and its users in Y Axis

## License

This project is licensed under the [MIT license](https://github.com/example/repo/blob/main/LICENSE).

## 📝 Contributers

- [Maisara Safwat](https://github.com/MaysaraSafwat)
- [Habiba Alaadin](https://github.com/habiba1999)
- [Omar Walid](https://github.com/omar456-asc)
- [Youssef Adel](https://github.com/YousefAdel2020)
- [Mahmoud Mohamed](https://github.com/Mahmoud1499)

## <div id="demo">Demo Video</div>

[![Website Demo Video](https://img.youtube.com/vi/66K75pk-yv0/0.jpg)](https://www.youtube.com/watch?v=66K75pk-yv0)
