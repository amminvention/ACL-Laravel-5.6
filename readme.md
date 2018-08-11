<h2>Set-up role based access control in Laravel</h2>
<hr>
Many a time in a web application you will need to protect certain resources from being accessed by all of your users. While an authentication system ensures that only authorized users are able to access your application but implementing a certain role-based access control is sometimes necessary. Let me show you how you can implement role based access control in Laravel.

We will not be using any external packages and just use Laravel Auth() to implement this. We will be implementing access control for 3 roles namely Admin, Moderator, and User for the User model provided by Laravel.
