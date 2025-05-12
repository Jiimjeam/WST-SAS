# add central app admin
        use App\Models\Admin;
        use Illuminate\Support\Facades\Hash;
        You sent
        Admin::create([
            'email' => 'limj1674@gmail.com',
            'password' => Hash::make('123123123')
        ]);

        
# Don't push github secret!
        git reset --soft HEAD~1
        git restore --staged .env
        git restore .env
        git commit -m "Remove secret from commit"

    

# Clinic Storage – Multi-Tenant Storage System

        Description:
            ResourceHub is a simple multi-tenant resource allocation system designed for businesses, schools, NGOs,
            and government offices. It helps organizations track and allocate resources such as equipment, supplies,
            or facilities to various departments or projects.
#             
       Functionalities (Simple CRUD-Based Features)
            1. Multi-Tenant System (One App, Multi-Database)
                Each organization (tenant) has its own database to store and manage resources.
                Super Admin oversees system-wide settings and subscriptions.
            
            2. CRUD Operations for Resource Management
                Create: Admins can add resources (e.g., office supplies, equipment) with details like name, quantity, and location.
                Read: Users can view available resources and their current status (Available, In Use, Under Maintenance).
                Update: Modify resource details, update quantity, or change status when allocated or returned.
                Delete: Remove obsolete or discarded resources.
    
            3. Resource Allocation & Tracking
                Assign resources to departments or projects.
                Track the current status resource.
                Monitor who is responsible for allocated resources.
            
            4. User Roles & Permissions
                Admin: Manages resources, assigns items, and tracks allocation.
                Employee/User: Can request resources and check availability.
                Tenant Model (Who are the Users?)
  #            
        Tenants
            Companies, schools, community centers, government agencies.
            Each tenant has a separate database to securely manage their resources.
  #          
        Pricing Model
            Free Plan:
                Limited to 20 resources.
                Basic CRUD operations.
                
            Standard Plan ($25/month per tenant):
                Unlimited resources.
                Custom status options.
                Basic reporting on resource utilization.
#            
     Customization & Auto-Updates
            Custom Branding: Add logos and colors for each organization.
            Auto Updates: Keep the system up to date with new features and improvements.




























    



