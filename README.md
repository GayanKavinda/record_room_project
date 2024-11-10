# 📂 Record Room Management System

A Laravel-based application for efficient tracking and management of files, departments, and record locations. The system includes role-based access and permission controls, designed for seamless usage and optimized with Tailwind CSS.

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

📁 app/ # Application logic, controllers, and models 📁 routes/ # Route definitions for different user roles 📁 resources/views/ # Blade templates for views


## ⚙️ Troubleshooting

### Common Issues

- ❗ **Unexpected token error**: If you encounter "Unexpected token '<'," ensure AJAX requests handle JSON responses correctly.
- ❗ **Undefined variable errors**: Check Blade component usage in `app.blade.php` for variables or structures like `<x-app-layout>`.

---

## 🤝 Contribution

Contributions are welcome! To contribute:

1. **Fork** the repository.
2. **Create a branch** for your feature.
3. **Submit a pull request** with a detailed description.

---

## 📜 License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.