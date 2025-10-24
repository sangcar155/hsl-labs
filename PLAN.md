1.Understanding of the Project Scope
    -The purpose of this project is to develop the foundation of an online      dashboard that allows Licensed Providers (plastic surgeons) to manage their supplement business with HSL Labs. The system will enable providers to place bulk orders, track inventory, and monitor patient subscriptions in a simple and organized way.

    -This dashboard aims to make the business process smoother by helping providers handle orders, inventory, and renewals without relying on manual tracking. The project will focus on building a clear and scalable Laravel structure, demonstrating good planning, clean code organization, and logical workflow — rather than completing a full production-ready system.

2. Assumptions

    1.User Roles: The system will have different roles, including Providers (doctors) and Provider Staff, each with specific access rights.

    2.Authentication: Users will log in securely before accessing the dashboard.

    3.Inventory Management: Each provider has their own inventory, which decreases automatically when orders are placed.

    4.Patient Plans: Patients follow recurring supplement plans (4 or 12 months), and the system can track start and end dates.

    5.Payment Handling: Payment processing will be simulated or handled separately; the focus is on order and inventory logic.

    6.Notifications: Email confirmations are sent when orders are placed, but complex notifications (SMS, push) are out of scope.

    7.Scalability: The dashboard structure should support adding more features later, such as reporting or analytics.

3. Main Components / Modules

    1. Providers Module:

    * Manage provider information (doctors) and their associated staff.
    * Handle roles and permissions for dashboard access.

    2. Products & Inventory Module:

    * Track products available for order.
    * Maintain provider-specific inventory levels and automatically update stock when orders are placed.

    3. Orders Module:

    * Allow providers to place wholesale product orders.
    * Record order details, quantities, and total cost.
    * Update inventory and generate confirmations.

    4. Patients Module:

    * Track patient information and their recurring supplement plans.
    * Monitor start and end dates of subscriptions.

    5. Notifications Module:

    * Send email confirmations for new orders.
    * Optional: future support for alerts for low stock or subscription reminders.

4.Key Questions before starting

    1. Roles & Permissions: How many user roles will the dashboard have, and what specific access should each role have?
    2. Order Details: What information is required when a provider places an order (e.g., shipping address, payment info, product variants)?
    3. Inventory Management: Will inventory be managed individually per provider, or centrally by HSL Labs?
    4. Payment Processing: Should payment be integrated now or only simulated for the MVP?
    5. Patient Plans: Are there different subscription types, and how should changes or cancellations be handled?
    6. Notifications: Should notifications be sent only by email, or do you also want SMS or other channels in the future?
    7. Reporting Needs: Are there any specific reports or dashboard views required for the providers or administrators?
    8. Compliance & Security: Are there any legal or regulatory requirements we need to consider for patient data or product sales?

5.Milestone Timeline – End-to-End Feature Implementation

    Day 1 – Planning & Setup

    * Set up Laravel project and Git repository
    * Define folder structure, modules, and choose feature (Option A or B)
    * Design database schema and create migrations + seeders

    Day 2 – Core Feature Build

    * Define routes and create thin controller
    * Implement Form Request for validation
    * Build Service/Action class with business logic
    * Add basic Policy for authorization

    Day 3 – Async Tasks & Testing

    * Implement Event/Listener or Job for email/async tasks
    * Write 1–2 feature tests (happy path + failure)
    * Update README/documentation with feature flow




