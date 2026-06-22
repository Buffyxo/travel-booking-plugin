# travel-booking-plugin
A travel booking system built as a custom WordPress plugin.

This wordpress plugin is developed with the purpose of exploring software architecture and design principles. It separates database access, business logic and HTTP handling into repositories, services and controllers. 

The plugin is still a work in progress, and part of the goal is to see how far this architecture can scale as new features are added.

## Architecture
Requests flow through the application as:
Route → Controller → Service → Repository → Database

## Current Features

### Tours
- Get all tours
- Get tour by ID
- Create tour
- Update tour
- Delete tour

### Infrastructure
- PSR-4 autoloading with Composer
- Dependency injection via composition root
- WordPress REST API
- Docker development environment

## Roadmap
- [x] Tour CRUD API
- [x] PSR-4 autoloading
- [x] Dependency injection
- [ ] Booking management
- [ ] Customer management
- [ ] Payment integration
- [ ] Email notifications
