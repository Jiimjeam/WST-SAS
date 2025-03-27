# MedTrack – Multi-Tenant Patient Record Management System
    Description
    
        MedTrack is a multi-tenant patient record management system designed for 
        small clinics, private doctors, and healthcare providers. It allows medical 
        professionals to store, update, and manage patient records securely, while each 
        clinic operates independently with its own database.
#
    Functionalities
    
      1. Multi-Tenant System (One App, Multi-Database)
          - Each clinic (tenant) gets its own dedicated database for patient records
          - Super Admin manages all tenants, system-wide updates, and pricing plans (kami ni)
      
      2. CRUD Operations for Patient Records
         - Create: Doctors can add new patient records with personal and medical details.
         - Read: View and search for patient history, prescriptions, and visit logs.
         - Update: Modify patient information, prescriptions, and treatment plans.
         - Delete: Remove old or duplicate patient records securely.
      
      3. Appointment Scheduling & Management
        - Doctors can schedule, reschedule, and cancel appointments
        - Doctors & Nurses can view a schedule of appointments
      
      4. Role-Based Access Control
        - Super Admin: Manages tenants, billing, and platform updates.
        - Clinic Admin (Tenant Owner): Manages doctors, patients, and billing.
        - Doctors: Manage patient records, appointments, and prescriptions.
        - Receptionists: Schedule appointments and handle billing.
        
#
    Pricing
    
        - Free Plan: Limited to 1 doctor, 50 patient records, and basic scheduling.
        - Pro Plan ($20/month): Unlimited doctors and patients, reports, and detailed scheculing
#
    Multi-Tenant Implementation

      - Laravel Package: Uses stancl/tenancy for multi-tenancy.
      - Database per Tenant: Each clinic has its own MySQL(phpmyadmin) database.
      - Authentication: Centralized login with tenant-based access control.
#
    Customization & Auto-Updates
      - Custom Branding: Clinics can add logos, theme colors.
      - Feature Toggles: Enable/disable feature.
      - Automatic/check for Updates: New features roll out without affecting existing data.










# FeedBackHub – Multi-Tenant Feedback Management System
    Description 

        FeedBackHub is a simple multi-tenant feedback management system designed for businesses, 
        schools, NGOs, and government agencies. It helps organizations collect, manage, and analyze
        feedback from employees, customers, or stakeholders in a structured way.

     Functionalities
    
      1. Multi-Tenant System (One App, Multi-Database)
          - Each organization (tenant) has its own database to store and manage feedback.
          - Super Admin oversees system-wide settings and subscriptions.
      
      2. CRUD Operations for Feedback Management
         - Users can submit feedback related to services, products, or workplace concerns.
         - Organizations can view submitted feedback and categorize it (e.g., Complaints, Suggestions,
         - Admins can respond to feedback, change statuses (e.g., Resolved, In Progress), and assign
         - Remove irrelevant or duplicate feedback entries.
      
      3. Feedback Categories & Status Tracking
        - Organizations can define custom categories (e.g., Customer Support, Facilities, IT Issues).
        - Track the status of feedback (New, In Review, Resolved).
      
      4. User Roles & Permissions
        - Admin: Manages feedback, assigns issues, and tracks resolutions.
        - Employee/User: Can submit feedback and view status updates.
        
#
    Tenants
        - Tenants: Schools, businesses, customer service departments, HR teams.
        - Each tenant has a separate database to securely store feedback.
#
    Pricing
    
        - Free Plan: Limited to 1 doctor, 50 patient records, and basic scheduling.
        - Pro Plan ($20/month): Unlimited doctors and patients, reports, and detailed scheculing
#
    Multi-Tenant Implementation

      - Laravel Package: Uses stancl/tenancy for multi-tenancy.
      - Database per Tenant: Each clinic has its own MySQL(phpmyadmin) database.
      - Authentication: Centralized login with tenant-based access control.
#
    Customization & Auto-Updates
      - Custom Branding: tenants can add logos, theme colors Custom, Organizations can personalize their dashboard.
      - Feature Toggles: Enable/disable feature.
      - Automatic/check for Updates: New features roll out without affecting existing data.




























    



