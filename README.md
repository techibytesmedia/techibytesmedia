# 🌐 Techibytes Media Platform

![License](https://img.shields.io/badge/license-Proprietary-blue)
![Framework](https://img.shields.io/badge/framework-Laravel%2013-red)
![Frontend](https://img.shields.io/badge/frontend-Blade%20%2B%20Tailwind%20CSS-06b6d4)
![Status](https://img.shields.io/badge/status-active-brightgreen)

This repository is the official digital platform for **Techibytes Media**, a software development and digital marketing agency serving clients from Abuja, Nigeria, and Seattle, USA.

Built on Laravel, it provides the foundation for Techibytes Media's public website and the digital experiences, tools, integrations, and services the company may introduce as its needs evolve.

> **We build digital products that move business forward.**

---

## ✨ Current Foundation

The platform currently includes:

- 🏠 Responsive agency landing page
- 🧩 Dedicated service, portfolio, and graphic design pages
- 📨 Validated project inquiry form with confirmation feedback
- 🔎 Page-specific metadata for search and social sharing
- 📱 Responsive navigation and mobile menu
- ♿ Reduced-motion support and progressively enhanced animations
- 🧪 Pest feature tests for public pages and contact submissions

This list represents the platform today, not its long-term limit. The application is expected to evolve alongside Techibytes Media, its clients, and its services.

---

## 🧰 Tech Stack

- **Language**: PHP 8.4
- **Framework**: Laravel 13
- **Templates**: Laravel Blade
- **Styling**: Tailwind CSS 4
- **Frontend Tooling**: Vite 8
- **Client-Side Behavior**: Vanilla JavaScript
- **Database**: SQLite by default
- **Testing**: Pest 4
- **Code Formatting**: Laravel Pint

---

## 📂 Current Public Experience

The current public-facing experience includes:

- `/` — Agency overview
- `/services` — Software, design, and marketing services
- `/portfolio` — Selected work and case-study previews
- `/graphics` — Branding and graphic design capabilities
- `/contact` — Project inquiry form and office details

Additional areas and capabilities may be introduced as the platform grows.

---

## 🛠️ Getting Started

### 1. Clone the Repository

```bash
git clone git@gitlab.com:techibytesmedia/techibytesmedia.git
cd techibytesmedia
```

### 2. Install and Configure the Application

The project provides a Composer setup command that installs dependencies, creates the environment file, generates an application key, runs migrations, and builds the frontend assets:

```bash
composer run setup
```

Review `.env` and update the application URL, mail settings, and database configuration for your environment.

### 3. Start Local Development

```bash
composer run dev
```

This starts the Laravel development server, queue listener, and Vite development server together.

### 4. Run the Test Suite

```bash
php artisan test --compact
```

---

## 👥 Contributing

We welcome contributions from trusted collaborators. Read [`CONTRIBUTING.md`](CONTRIBUTING.md) and our [`CODE_OF_CONDUCT.md`](CODE_OF_CONDUCT.md) before opening a merge request.

📧 Contact [dev@techibytesmedia.com](mailto:dev@techibytesmedia.com) for repository access or development questions.

---

## 🔐 Security

Please do not disclose vulnerabilities through a public issue. Read [`SECURITY.md`](SECURITY.md) and report security concerns privately to [security@techibytesmedia.com](mailto:security@techibytesmedia.com).

---

## 📬 Support

- 💬 Use the project issue tracker for reproducible bugs and approved feature requests
- 📧 Email [support@techibytesmedia.com](mailto:support@techibytesmedia.com)
- 🌐 Visit [techibytesmedia.com](https://techibytesmedia.com)

---

## 👨‍💻 Authors

Built and maintained by the **Techibytes Media Dev Team**.

💻 [techibytesmedia.com](https://techibytesmedia.com)

---

## 📝 License

This software and its source code are proprietary and confidential. All rights are reserved by **Techibytes Media LLC**. Unauthorized reproduction, modification, or distribution is prohibited. See [`LICENSE.md`](LICENSE.md) for details.

© 2020–Present Techibytes Media LLC. All rights reserved.

---

## 📊 Project Status

🚧 Actively maintained and under continuous development.
