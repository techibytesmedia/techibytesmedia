# 👥 Contributing to the Techibytes Media Website

Thank you for your interest in contributing to the **Techibytes Media website**.

We welcome focused contributions from trusted collaborators that improve the site's content, accessibility, performance, reliability, and visitor experience.

## 🧱 Development Workflow

1. Fork or clone the repository using your approved access.
2. Create a focused branch from `main`:

   ```bash
   git checkout -b feature/my-change
   ```

3. Install and configure the project:

   ```bash
   composer run setup
   ```

4. Make your changes using the conventions already established in nearby files.
5. Add or update tests for behavior that changes.
6. Format modified PHP files:

   ```bash
   vendor/bin/pint --dirty --format agent
   ```

7. Run the test suite:

   ```bash
   php artisan test --compact
   ```

8. If frontend assets changed, verify the production build:

   ```bash
   npm run build
   ```

9. Open a merge request with a clear title, summary, test evidence, and screenshots for visible interface changes.

All merge requests must be reviewed and pass the project's required checks before being merged.

## 📌 Contribution Guidelines

- Follow the repository instructions in `AGENTS.md` and the conventions in sibling files
- Follow Laravel conventions and use descriptive names
- Keep changes focused and small enough to review confidently
- Use Blade components and existing UI patterns before creating new ones
- Preserve responsive behavior, keyboard usability, semantic markup, and reduced-motion support
- Use named routes when linking to application pages
- Keep database access and business logic out of Blade templates
- Add or update Pest tests for changed behavior
- Write meaningful commit messages
- Reference related issues in the merge request
- Never commit secrets, `.env` files, production data, or visitor inquiries
- Do not add or upgrade dependencies without approval

## 🧪 Areas That Need Extra Care

- **Contact submissions** — validation, CSRF protection, spam prevention, privacy, and delivery must remain reliable
- **SEO metadata** — preserve accurate titles, descriptions, canonical behavior, and social metadata
- **Navigation and routes** — links must work across desktop and mobile layouts
- **Responsive design** — verify common phone, tablet, and desktop widths
- **Accessibility** — retain usable focus states, labels, contrast, semantic structure, and reduced-motion behavior
- **Public content** — confirm client names, testimonials, statistics, addresses, and contact details before publication

## 💬 Feedback and Questions

Use the project issue tracker for approved bugs or feature proposals, or contact:

📧 **dev@techibytesmedia.com**
