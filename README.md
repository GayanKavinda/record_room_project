# 📂 Record Room Management System For Ministry of Home Affairs in Sri Lanka (IT Division)

A Laravel-based application for efficient tracking and management of files, departments, and record locations. The system includes role-based access and permission controls, designed for seamless usage and optimized with Tailwind CSS.

![Record Room Management System](https://github.com/GayanKavinda/record_room_project/blob/Gayan/Project%20Showcase/1.%20Start%20Screen.png)

## ✨ Features

- 🔒 **Role-Based Access Control**  
  - Different permissions for `Admin`, `Primary User`, and `Record Room` roles.
  - Full CRUD operations for departments, files, permissions, roles, and users.

- 🗄️ **File Location Assignment**  
  - Assign rack locations (rack letter, sub-rack, and cell number) to files.
  - Once assigned, files appear in the `Stored Files` section with assigned department details.

- 🕒 **Status Management**  
  - Change file status to **Pending** when sent to the record room.
  - Disables **Edit** and **Delete** actions until super admin processing.

- 🎨 **Modern UI/UX**  
  - Developed with Tailwind CSS for a sleek, responsive interface.
  - Disabled buttons display a "locked" tooltip and different color, following original color schemes.

- ⚠️ **Error Handling**  
  - Comprehensive validation and error feedback for robust user experience.

![Record Room Management System](https://github.com/GayanKavinda/record_room_project/blob/Gayan/Project%20Showcase/5.%20Super%20Admin%20Home%20Page.png)

---

## 🗂️ Activity Logs

The system includes different sections for tracking activities related to files, users, departments, and permissions. Here's an overview of the activity logs:

- 🗃️ **File Activity Logs**  
  This log tracks activities related to file operations, such as file creation, modifications, deletions, and status changes. It helps in auditing file management activities and provides transparency in file handling.

- 👤 **User Activity Logs**  
  The user activity log records actions taken by users within the system. This includes logins, updates to user profiles, and changes in permissions or roles. It is vital for monitoring user behavior and ensuring security compliance.

- 🏢 **Department Activity Logs**  
  Tracks activities related to department management, such as department creation, updates to department information, and assigning files to departments. This log ensures that all department-related actions are properly documented.

- 🔑 **Permission Activity Logs**  
  This log captures all changes in permissions, including granting, revoking, or modifying user permissions for various roles. It is essential for tracking permission adjustments and ensuring the security of the system.

- ⚙️ **Role Activity Logs**  
  The role activity log monitors changes to user roles, such as role assignments, updates, and removals. It plays a critical role in maintaining a secure and well-organized access control system. *Filtering functionality is available in this section to easily find specific role changes.*

---

## 🖼️ Slideshow

![Slide 1](https://github.com/GayanKavinda/record_room_project/blob/Gayan/Project%20Showcase/5.%20Super%20Admin%20Home%20Page.png)
*Caption for Slide 1*

![Slide 2](https://github.com/GayanKavinda/record_room_project/blob/Gayan/Project%20Showcase/1.%20Start%20Screen.png)
*Caption for Slide 2*

![Slide 3](https://github.com/GayanKavinda/record_room_project/blob/Gayan/Project%20Showcase/5.%20Super%20Admin%20Home%20Page.png)
*Caption for Slide 3*

---

## 🛠️ Installation

1. **Clone the repository**:
    ```bash
    git clone https://github.com/your-username/record-room-management-system.git
    cd record-room-management-system
    ```

2. **Install dependencies**:
    ```bash
    composer install
    npm install
    ```

3. **Configure environment**:  
   Copy `.env.example` to `.env` and set your database and environment variables.

4. **Generate application key**:
    ```bash
    php artisan key:generate
    ```

5. **Run migrations**:
    ```bash
    php artisan migrate
    ```

6. **Optional: Seed the database**:
    ```bash
    php artisan db:seed
    ```

7. **Start the development server**:
    ```bash
    php artisan serve
    ```

---

## 🚀 Usage

- **Role & Permission Management**: Manage users and assign roles (`admin`, `primary-user`, `record_room`), with access control for functionalities.
- **File Assignment**: Navigate to the Record Room section to assign file rack locations.
- **Status Updates**: Set file status to **Pending** by clicking the 'Send to Record Room' button, which disables edit/delete options.
- **Quick Links**:
  - `/record-room` - Record Room rack location assignments.
  - `/stored-files` - View all stored files and associated departments.

---

## 🗂️ Project Structure

The system is built using Laravel MVC with Tailwind CSS for styling. Here’s an overview of key directories:

📁 app/ # Application logic, controllers, and models 
📁 routes/ # Route definitions for different user roles 
📁 resources/views/ # Blade templates for views

---

## ⚙️ Troubleshooting

### Common Issues

- ❗ **Unexpected token error**: If you encounter "Unexpected token '<'," ensure AJAX requests handle JSON responses correctly.
- ❗ **Undefined variable errors**: Check Blade component usage in `app.blade.php` for variables or structures like `<x-app-layout>`.

---

## 👥 Developers

This project was developed by a team of talented individuals:

- **Gayan Kavinda**  
  - Institution: SLIIT University  
  - Role: Fresh Graduate  

- **Didula Senevirathna**  
  - Institution: IIT University  

- **Nipuna Gamage**  
  - Institution: IIT University  

Each developer has contributed to various parts of this project to create a comprehensive and functional record management system. Special thanks to all team members for their dedication and contributions.

---

## 🤝 Contribution

Contributions are welcome! To contribute:

1. **Fork** the repository.
2. **Create a branch** for your feature.
3. **Submit a pull request** with a detailed description.

---

## 📜 Ownership & License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

All rights to the codebase belong to the developers mentioned above. Please credit the authors if using or modifying parts of this project. Unauthorized copying or redistribution of substantial parts of this project is not permitted without prior permission from the authors.
