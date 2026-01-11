# Booking System Task

## Setup Instructions

### Prerequisites
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL

### Installation

1. **Clone the repository**
   ```bash
   git clone <repository_url>
   cd task_interview_booking_saudi
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Configure your database credentials in the `.env` file.*

4. **Database Migration**
   ```bash
   php artisan migrate
   ```

5. **Run Application**
   - Start the backend server:
     ```bash
     php artisan serve
     ```
   - Start frontend dev server (Vite):
     ```bash
     npm run dev
     ```

## Design Notes

### Architecture
- **Framework**: Laravel 12.0
- **Pattern**: MVC (Model-View-Controller)
- **Frontend**: Blade Templates + TailwindCSS 4.0 (via Vite)
- **API**: RESTful API for client-side consumption (Mobile/Frontend App)

### Features & Implementation
- **Authentication**:
  - **Web (Admin)**: Session-based auth with Role-Based Access Control (RBAC).
  - **API**: Token-based auth using **Laravel Sanctum**. Includes OTP verification flows.
- **Authorization**:
  - Middleware (`is_role`) and Policies used to manage access to resources (Services, Bookings).
- **Localization**:
  - Supports Multi-language (Arabic/English).
  - Uses `mcamara/laravel-localization` for Web routes.
  - Custom `lang` middleware for API response localization.
- **Media Handling**:
  - Standardized image upload/deletion via custom Traits (e.g., `HasImage`).

### Database Schema Key Entities
- **Users**: Admin, Providers, and Customers.
- **Services**: Manageable service listings.
- **Bookings**: Appointment and reservation records.
- **TimeSlots**: Availability scheduling for services.
