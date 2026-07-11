# 🔐 Security Policy

## 📅 Supported Versions

Techibytes Media applies security updates to the latest deployed version of this website. Older, unreleased, and independently modified builds are not supported.

## 📢 Reporting Vulnerabilities

If you discover a security vulnerability, **do not disclose it publicly or open a public issue**.

Report it privately to:

📧 **security@techibytesmedia.com**

Please include:

- A clear description of the vulnerability and its potential impact
- Reproduction steps or a proof of concept
- The affected page, route, component, or configuration
- Any conditions required to reproduce the issue
- Suggested remediation, if available

We will acknowledge the report as quickly as possible, investigate it, and provide updates where appropriate. Please allow a reasonable remediation period before any public disclosure.

## 🔐 Security Expectations

Contributions must preserve the security and privacy of the website and its visitors:

- Validate all untrusted input on the server
- Escape output and use Blade's safe rendering defaults
- Protect state-changing requests with CSRF protection
- Apply authorization policies before introducing restricted functionality
- Do not commit credentials, API keys, `.env` files, or customer information
- Avoid logging sensitive inquiry data unless it is operationally necessary and appropriately protected
- Add throttling and abuse protection to public submission endpoints where appropriate
- Keep Laravel, PHP, Node.js, and frontend dependencies updated
- Review third-party integrations before transmitting visitor data
- Use HTTPS in staging and production

Thank you for helping keep Techibytes Media and its visitors safe.
