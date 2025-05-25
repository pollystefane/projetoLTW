

## Features

**User:**
- [x] Register a new account.
- [x] Log in and out.
- [ ] Edit their profile, including their name, username, password, and email.

**Freelancers:**
- [x] List new services, providing details such as category, pricing, delivery time, and service description, along with images or videos.
- [x] Track and manage their offered services.
- [ ] Respond to inquiries from clients regarding their services and provide custom offers if needed.
- [ ] Mark services as completed once delivered.

**Clients:**
- [x] Browse services using filters like category, price, and rating.
- [ ] Engage with freelancers to ask questions or request custom orders.
- [ ] Hire freelancers and proceed to checkout (simulate payment process).
- [ ] Leave ratings and reviews for completed services.

**Admins:**
- [ ] Elevate a user to admin status.
- [ ] Introduce new service categories and other pertinent entities.
- [ ] Oversee and ensure the smooth operation of the entire system.

**Extra:**
- [x] Search bar with dynamic filtering.
- [x] Delete own services.
- [x] Session-based access control.

## Running

    sqlite3 database/database.db < database/database.sql
    php -S localhost:9000

## Credentials

- maria@gmail.com / 1234
