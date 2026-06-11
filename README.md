# Bookbus - Bus Reservation Platform

Bookbus is a modern bus ticket reservation system built with Laravel. It allows users to search for bus trips between cities, view available segments, and book their seats online.

## 🚀 Features

- **Trip Search**: Find available bus trips by specifying departure/arrival cities and travel date.
- **Seat Reservation**: Real-time seat availability tracking and booking system.
- **User Dashboard**: Manage your bookings, view ticket details, and cancel reservations.
- **Profile Management**: Secure user authentication and profile updates using Laravel Breeze.
- **Multi-segment Routes**: Support for complex routes with multiple stops (etapes).

## 🛠️ Tech Stack

- **Framework**: [Laravel 12](https://laravel.com)
- **Frontend**: Blade, Tailwind CSS, Vite
- **Authentication**: [Laravel Breeze](https://laravel.com/docs/breeze)
- **Database**: MySQL / PostgreSQL / SQLite
- **Testing**: [Pest PHP](https://pestphp.com)

## 📋 Prerequisites

- PHP >= 8.2
- Composer
- Node.js & NPM
- A database (MySQL, PostgreSQL, or SQLite)

## ⚙️ Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd bookbus
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Configure your database settings in the `.env` file.*

4. **Run Migrations & Seeders**
   ```bash
   php artisan migrate --seed
   ```

5. **Build Assets**
   ```bash
   npm run dev
   ```

6. **Start the Server**
   ```bash
   php artisan serve
   ```

## 🧪 Testing

The project uses Pest PHP for testing. To run the test suite:

```bash
php artisan test
```

## 📂 Project Structure

- `app/Models`: Contains domain models like `Bus`, `Programme`, `Segment`, `Reservation`, etc.
- `app/Http/Controllers`: Logic for trip searching and booking management.
- `resources/views`: Blade templates for the frontend.
- `database/migrations`: Database schema definitions.

## 📄 License

The Bookbus platform is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
